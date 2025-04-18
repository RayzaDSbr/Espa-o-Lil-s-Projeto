<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "espacolilas";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT nome_paciente, data_agendamento, tipo_consulta FROM agendamento ORDER BY data_agendamento ASC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ver Agendamentos</title>
    <link rel="stylesheet" href="style.css"> <!-- Se estiver usando um arquivo externo -->
  
    <style>

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--roxo);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="logo">
     <a href="index.html">
         <img src="img/logo.png" alt="Logo">
     </a>
      <span>Gerenciador Espaço Lilás</span>
    </div>
    <nav class="menu">
    <a href="ver_agendamento.php">Agendamentos</a>
      <a href="pacientes.html">Pacientes</a>
      <a href="estoque.html">Estoque</a>
    </nav>
  </header>

    <div class="conteudo">
        <div class="caixa-branca">
        <a href="fzagendamento.html" class="botao">Novo Agendamento</a>
            <h1>Agendamentos Marcados:</h1> 
            <?php
            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Nome do Paciente</th><th>Data</th><th>Tipo de Consulta</th></tr>";

                while ($linha = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($linha["nome_paciente"]) . "</td>";
                    echo "<td>" . date("d/m/Y", strtotime($linha["data_agendamento"])) . "</td>";
                    echo "<td>" . htmlspecialchars($linha["tipo_consulta"]) . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Nenhum agendamento encontrado.</p>";
            }

            $conn->close();
            ?>
            <br>
         
        </div>
    </div>

    <div class="rodape">
        &copy; <?php echo date("Y"); ?> Desenvolvido pelo grupo do Projeto Interdisciplinar - FAM - Mooca - ADS
    </div>
</body>
</html>