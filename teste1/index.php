<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cliente</title>
</head>
<body>
    <h1> Tela de login do Sistema</h1>
    <form action="menu.php" method="POST">
        <fieldset>
            <legend>Dados: </legend>
            <table> 
                <tbody>
                    <tr>
                        <td>Usuario:</td>
                        <td><input type="text" name="usuario"/></td>
                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input type="password" name="senha"/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Entrar"/></td>
                    </tr>

                </tbody> 
 
            </table>
       </fieldset>
    </form>
</body>
</html>