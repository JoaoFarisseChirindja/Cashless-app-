<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1>Adminstrador</h1>



<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
    Adicionar Usuário
</button>
<div class="listagem">

</div>

@include('actors.admin.users.index')
@include('actors.admin.users.create')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
