<?php
$host = "localhost";
$usuario = "root";
$senha = ""; // coloque sua senha aqui, se tiver
$banco = "espacolilas";

// Conectar ao banco
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados do formulário
$nome = $_POST['nome'];
$data = $_POST['data'];
$tipo = $_POST['tipo'];

// Inserir no banco
$sql = "INSERT INTO agendamento (nome_paciente, data_agendamento, tipo_consulta)
        VALUES ('$nome', '$data', '$tipo')";

if ($conn->query($sql) === TRUE) {
    header("Location: confirmacao_agen.html");
    exit();
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>