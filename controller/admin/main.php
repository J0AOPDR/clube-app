<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>Document</title>
    <script src="../../js/apexcharts.min.js"></script>
    <?php session_start() ?>
</head>
<body>
    <div class="left-box">
        <div class="left-box-painel">
            <div class="left-box-inicio">
                <a href="../admin/main.php">
                    <button class="img-btn no-border">
                        <img src="../../css/img/inicio.png" alt="Início">
                    </button>
                </a>
            </div>
            <div class="painel-line"></div>

            <div class="left-box-img">
                <a href="../admin/mainFunc/mainAtleta.php">
                    <button class="img-btn no-border">
                        <img src="../../css/img/membros.png" alt="Membros">
                    </button>
                </a>
            </div>

            <div class="left-box-img">
                <a href="../admin/mainFunc/mainModalidade.php">
                    <button class="img-btn no-border">
                        <img src="../../css/img/horarios.png" alt="Horários">
                    </button>
                </a>
            </div>

            <div class="left-box-img">
                <a href="../admin/mainFunc/mainHorarios.php">
                    <button class="img-btn no-border">
                        <img src="../../css/img/modalidades.png" alt="Modalidades">
                    </button>
                </a>
            </div>
            <div id="exit" class="left-box-img">
                <a href="../admin/form.php">
                    <button class="img-btn no-border">
                        <img src="../../css/img/exit.png" alt="Modalidades">
                    </button>
                </a>
            </div>


        </div>
    </div>

    <div class="mid-box">
        <div class="mid-box-atletas">
            <div class="text-box-atletas">
                <h1>Trabalho em equipe é sempre bom!</h1>
            </div>
            <div class="btn-box-atletas">
                <p>Adicione mais membros à equipe para um desenvolvimento ainda melhor das habilidades do time. Juntos somos mais fortes!</p>
                <a href="funcAdmin/addAtleta.php">
                    <button>
                        <img src="../../css/img/addBtn.png" alt="Adicionar">Adicionar
                    </button>
                </a>
            </div>
        </div>

        <div class="mid-box-containers">
            <div class="mid-box-membros">
                <div class="membros-title">
                    <h1>Time</h1>
                </div>

                <div class="membros-view">
                    <div class="circle-container">
                        <div class="list-circle">
                        <?php 
                            include('../conn.php');

                            $resultados = mysqli_query($conn, 'select nome_modalidade,vitorias,derrotas,empates from modalidade_estatistica inner join clube_modalidade on id_modalidade = id');
                            $dados = mysqli_fetch_array($resultados, MYSQLI_ASSOC);

                            $sql = 'SELECT clube_atleta.id, nome, nome_modalidade, avaliacao, DATE_FORMAT(clube_atleta.data_criacao, "%d/%m/%Y") AS data_formatada FROM clube_atleta inner join clube_modalidade on id_modalidade = clube_modalidade.id';
                            $atletas = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($atletas) > 0) {
                                foreach ($atletas as $atleta) {
                        ?>
                             <div class="membro">
                                <div class="membros-circle"><img src="../../css/img/admin.png" alt=""></div>
                                <p class="nome-jogador"><?php echo htmlspecialchars($atleta['nome']); ?></p>
                            </div>
                        <?php 
                                }
                            }else{
                                ?> <h2>Sem jogadores por enquanto!</h2> <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mid-box-modalidades">
                <div class="membros-title">
                    <h1>Modalidades</h1>
                </div>

                <div class="modalidades-view">
                    <p>Torne seu clube ainda mais lucrativo e popular adicionando novas modalidades esportivas!</p>
                    <a href="funcAdmin/addModalidade.php">
                        <button>
                            <img src="../../css/img/addBtn.png" alt="Adicionar">Adicionar
                        </button>
                    </a>
                </div>
            </div>

            <div class="mid-box-horarios">
                <div class="membros-title">
                    <h1>Horários</h1>
                </div>

                <div class="horarios-view">
                    <p>Marque e analise os horários das atividades do clube!</p>
                    <a href="funcAdmin/addHorario.php">
                        <button id="btn-horarios">
                            <img src="../../css/img/addBtn.png" alt="Adicionar">Adicionar
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="low-mid-box">
            <div class="box-stats">
                <div class="membros-title">
                    <h1>Estatísticas</h1>
                    <a href="funcAdmin/addEstatistica.php">
                        <button id="btn-horarios">
                            <img src="../../css/img/addBtn.png" alt="Adicionar">Adicionar
                        </button>
                    </a>
                </div>
                <div class="stats-view">
                    <div id="grafico"></div>
                </div>
            </div>

            <div class="low-mid-box-right">
                <div class="box-treino">
                    <div class="front-box">
                        <img src="../../css/img/treino.png" alt="Treino">
                        <div class="treino-hora">
                            <p id="treino">Treino</p>
                            <p id="horario">7 da manhã</p>
                        </div>
                    </div>
                    <div class="between-box"></div>
                    <div class="back-box"></div>
                </div>

                <div class="box-central">
                    <div class="membros-title">
                        <h1>Central</h1>
                    </div>
                    <div class="central-view">
                        <p>Verifique a central de notícias e notificações do clube para ficar ligado em tudo que acontece por aqui!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="right-box">
        <div class="box-notifi-title">
            <h1>Notificações</h1>
            <p id="geral-not">Geral</p>
            <div class="notifi-geral">
                <?php
                $sql = "SELECT mensagem, DATE_FORMAT(data_criacao, '%d/%m/%Y %H:%i') AS data FROM notificacoes ORDER BY data_criacao DESC";
                $result = mysqli_query($conn, $sql);
                $notificacoes = mysqli_fetch_all($result, MYSQLI_ASSOC);
                 
                foreach ($notificacoes as $notificacao) { ?>
                    <div class="box-mensagem">
                        <div class="left-msg">
                            <img src="../../css/img/mensagens.png" alt="Notificação">
                        </div>
                        <div class="text-msg">
                            <p><?= htmlspecialchars($notificacao['mensagem']); ?></p>
                            <small><?= $notificacao['data']; ?></small>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="notifi-line"></div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        let el = document.getElementById("grafico");
        if (el) {
            let options = {
                chart: {
                    type: 'bar',
                    height: 300,
                    width: 600,
                    toolbar: {
                    show: true
                    }
                },
                series: [
                    {
                        name: 'Jogos',
                        data: [<?= $dados['vitorias'] ?>,<?= $dados['derrotas'] ?>]
                    }
                ],
                xaxis: {
                    categories: ['Vitórias', 'Derrotas'],
                    title: {
                        text: 'Resultados'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Quantidade'
                    }
                },
                colors: ['#3C56FF', '#00000'],
                title: {
                    text: 'Desempenho em Jogos',
                    align: 'center',
                    style: {
                        fontSize: '18px',
                        fontWeight: 'bold'
                    }
                }
            };

            try {
                let chart = new ApexCharts(el, options);
                chart.render();
            } catch (error) {
                console.error("Erro ao renderizar o gráfico:", error);
            }
        } else {
            console.error("Elemento com ID 'grafico' não encontrado.");
        }
    });
    </script>

    <script>
    function notifi() {
        fetch('../../../controller/fetch_notifications.php')
            .then(response => response.json())
            .then(data => {
                let notifiBox = document.getElementById("geral-not");
                let notificationText = data.message;
                notifiBox.innerText = notificationText;
            })
            .catch(error => console.error("Erro ao carregar notificações:", error));
    }

    setInterval(notifi, 10000);
    </script>
</body>
</html>
