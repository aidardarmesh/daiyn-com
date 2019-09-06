print = document.getElementById('print');

print.onclick = function(){
  if(isEmailCorrect(email.value) && isPhoneCorrect(phone.value)){
    if(filesNumber(data) != 0){
        // APPENDING DATA INFO TO FORM
        var form = new FormData();
        for(var i in data){
            form.append('files[]', data[i].file);
        }
        form.append('data', JSON.stringify(data));
        form.append('email', email.value);
        form.append('phone', phone.value);

        // ACTUAL SENDING
        var xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if(this.responseText){
                var response = JSON.parse(this.responseText);
                var form = document.getElementById('epay-form');
                var soInput = document.getElementById('epay-signed-order');
                var emailInput = document.getElementById('epay-email');
                var backLinkInput = document.getElementById('epay-backlink');
                soInput.value = response.signed_order;
                emailInput.value = response.email;
                backLinkInput.value = 'https://daiyn.com/order.php?order_id=' + response.order_id + "&email=" + response.email;
                form.submit();
            }
        }
        xhr.open('POST', 'order_epay.php');
        xhr.send(form);

        // SHOWING OVERLAY TO FREEZE WEBSITE
        document.getElementById("overlay").style.display = "block";
    } else {
        alert("Нет файлов для отправки");
    }
  } else {
    alert("Введите email и номер правильно");
  }
}
