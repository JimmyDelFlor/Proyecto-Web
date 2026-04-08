<?php
require_once("Controlador/header.php");
require_once("Controlador/clases/Account.php");
require_once("Controlador/clases/FormSanitizer.php");
require_once("Controlador/clases/SettingsFormProvider.php");
require_once("Controlador/clases/Constants.php");

if(!usuario::isLoggedIn()) {
    header("Location: IniciarSesion.php");
}

$detailsMessage = "";
$passwordMessage = "";
$formProvider = new SettingsFormProvider();

if(isset($_POST["saveDetailsButton"])) {
    $account = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormString($_POST["email"]);

    if($account->updateDetails($firstName, $lastName, $email, $userLoggedInObj->getusername())) {
        $detailsMessage = "<div class='alert alert-success'>
                                <strong>SUCCESS!</strong> ¡Detalles actualizados exitosamente!
                            </div>";
    }
    else {
        $errorMessage = $account->getFirstError();

        if($errorMessage == "") $errorMessage = "Algo salió mal";

        $detailsMessage = "<div class='alert alert-danger'>
                                <strong>ERROR!</strong> $errorMessage
                            </div>";
    }
}

if(isset($_POST["savePasswordButton"])) {
    $account = new Account($con);

    $oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
    $newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
    $newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);

    if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedInObj->getusername())) {
        $passwordMessage = "<div class='alert alert-success'>
                                <strong>SUCCESS!</strong> ¡Contraseña actualizada exitosamente!
                            </div>";
    }
    else {
        $errorMessage = $account->getFirstError();

        if($errorMessage == "") $errorMessage = "Algo salió mal";

        $passwordMessage = "<div class='alert alert-danger'>
                                <strong>ERROR!</strong> $errorMessage
                            </div>";
    }
}
?>
<div class="settingsContainer column">

    <div class="formSection">
        <div class="message">
            <?php echo $detailsMessage; ?>
        </div>
        <?php
            echo $formProvider->createUserDetailsForm(
                isset($_POST["firstName"]) ? $_POST["firstName"] : $userLoggedInObj->getFirstName(),
                isset($_POST["lastName"]) ? $_POST["lastName"] : $userLoggedInObj->getLastName(),
                isset($_POST["email"]) ? $_POST["email"] : $userLoggedInObj->getEmail()
            );
        ?>
    </div>

    <div class="formSection">
        <div class="message">
            <?php echo $passwordMessage; ?>
        </div>
        <?php
            echo $formProvider->createPasswordForm();
        ?>
    </div>

</div>