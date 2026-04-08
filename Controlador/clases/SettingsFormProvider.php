<?php 
  class SettingsFormProvider {

    public function createUserDetailsForm($firstName, $lastName, $email) {
      $firstNameInput = $this->createFirstNameInput($firstName);
      $lastNameInput = $this->createLastNameInput($lastName);
      $emailInput = $this->createEmailInput($email);
      $saveButton = $this->createSaveUserDetailsButton();

      return "<form action='settings.php' method='POST' enctype='multipart/form-data'>
                <span class='title'>Datos del usuario</span>
                $firstNameInput
                $lastNameInput
                $emailInput
                $saveButton
              </form>";
    }

    public function createPasswordForm() {
      $oldPasswordInput = $this->createPasswordInput("oldPassword", "Contraseña anterior");
      $newPassword1Input = $this->createPasswordInput("newPassword", "Contraseña nueva");
      $newPassword2Input = $this->createPasswordInput("newPassword2", "Confirmar contraseña nueva");
      $saveButton = $this->createSavePasswordButton();

      return "<form action='settings.php' method='POST' enctype='multipart/form-data'>
                <span class='title'>Actualizar contraseña</span>
                $oldPasswordInput
                $newPassword1Input
                $newPassword2Input
                $saveButton
              </form>";
    }

    private function createFirstNameInput($value) {
      if($value == null) $value = "";
      return "<div class='form-group'>
                <input class='form-control' type='text' placeholder='Nombre(s)' name='firstName' value='$value' required>
              </div>";
    }

    private function createLastNameInput($value) {
      if($value == null) $value = "";
      return "<div class='form-group'>
                <input class='form-control' type='text' placeholder='Apellidos' name='lastName' value='$value' required>
              </div>";
    }

    private function createEmailInput($value) {
      if($value == null) $value = "";
      return "<div class='form-group'>
                <input class='form-control' type='email' placeholder='Email' name='email' value='$value' required>
              </div>";
    }

    private function createSaveUserDetailsButton() {
      return "<button type='submit' class='btn btn-primary' name='saveDetailsButton'>Guardar</button>";
    }

    private function createSavePasswordButton() {
      return "<button type='submit' class='btn btn-primary' name='savePasswordButton'>Guardar</button>";
    }

    private function createPasswordInput($name, $placeholder) {
      return "<div class='form-group'>
                <input class='form-control' type='password' placeholder='$placeholder' name='$name' required>
              </div>";
    }
  }
?>