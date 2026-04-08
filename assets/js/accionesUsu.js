function subscribe(userTo, userFrom, button) {
    if(userTo == userFrom) {
      alert("No puedes suscribirte a ti mismo");
      return;
    }
  
    // AJAX call (POST)
    $.post("ajax/subscribe.php", { userTo: userTo, userFrom: userFrom })
    .done(function (data) {
      if(data != null) {
        $(button).toggleClass("subscribe unsubscribe");
        var buttonText = $(button).hasClass("subscribe") ? "SUBSCRIBETE" : "SUBSCRITO ";
        $(button).text(buttonText + " " + data);
      } else {
        alert("Algo salió mal");
      }
    });
  
  }