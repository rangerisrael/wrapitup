<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SendForm</title>
</head>

<body>
  <div>
    <form id="sendForm" method="#">
      Email<input type="email" name="email" id="email" /><br />
      Subject<input type="text" name="subject" id="subject" /><br />
      Message<textarea name="message" id="" cols="30" rows="10"> </textarea>
      <br />
      <button type="submit">Send email</button>
    </form>
  </div>
</body>

<script>



  async function fetchRequest(url, data) {
    const res = await fetch(url, {
      method: "POST",
      header: {
        "Content-type": "application/json; charset=UTF-8"
      },
      body: JSON.stringify(data)
    }).catch(() =>
      isErrorHandler()
    );

    const resp = await res.text();

    console.log(resp)


  }




  var form = document.getElementById('sendForm');



  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const data = {
      "email": e.target.elements['email'].value,
      "subj": e.target.elements['subject'].value,
      "msg": e.target.elements['message'].value,
    }


    fetchRequest('./mail-setup.php', data);

  });
</script>

</html>