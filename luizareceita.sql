-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 17/04/2026 às 05:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `luizareceita`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome_categoria`) VALUES
(1, 'Café da Manhã'),
(2, 'Almoço'),
(3, 'Lanche'),
(4, 'Jantar');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `criado_em` date DEFAULT NULL,
  `comentario` mediumtext DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `receita_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `criado_em`, `comentario`, `usuario_id`, `receita_id`) VALUES
(1, '2026-04-13', 'Adorei, muito saborosa', 4, 1),
(2, '2026-04-14', 'Que delícia, mal posso esperar para fazer essa', 2, 23);

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id_favorito` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `receita_id` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`id_favorito`, `usuario_id`, `receita_id`, `criado_em`) VALUES
(3, 2, 1, '2026-03-01 22:58:28'),
(9, 4, 1, '2026-04-13 19:17:01'),
(11, 5, 1, '2026-04-13 20:06:20'),
(13, 9, 1, '2026-04-15 04:13:10'),
(14, 9, 25, '2026-04-15 04:14:52'),
(15, 9, 3, '2026-04-15 04:14:54'),
(16, 9, 6, '2026-04-15 04:14:55'),
(17, 9, 5, '2026-04-15 04:14:55'),
(18, 9, 4, '2026-04-15 04:14:56'),
(19, 9, 7, '2026-04-15 04:14:57'),
(20, 9, 8, '2026-04-15 04:14:58'),
(21, 9, 9, '2026-04-15 04:14:59'),
(22, 9, 12, '2026-04-15 04:15:00'),
(23, 9, 11, '2026-04-15 04:15:01'),
(24, 9, 10, '2026-04-15 04:15:02'),
(25, 9, 13, '2026-04-15 04:15:03'),
(26, 9, 14, '2026-04-15 04:15:04'),
(27, 9, 15, '2026-04-15 04:15:05'),
(28, 9, 18, '2026-04-15 04:15:06'),
(29, 9, 17, '2026-04-15 04:15:07'),
(30, 9, 19, '2026-04-15 04:15:08'),
(31, 9, 22, '2026-04-15 04:15:10'),
(32, 9, 20, '2026-04-15 04:15:13'),
(33, 9, 24, '2026-04-15 04:15:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id_ingrediente` int(11) NOT NULL,
  `nome_ingrediente` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `receitas`
--

CREATE TABLE `receitas` (
  `id_receita` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(155) NOT NULL,
  `descricao` mediumtext DEFAULT NULL,
  `tempo_preparo` int(11) NOT NULL,
  `porcoes` int(11) NOT NULL,
  `cadastrada_em` date NOT NULL,
  `foto` varchar(255) DEFAULT 'default.jpg',
  `historia` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `receitas`
--

INSERT INTO `receitas` (`id_receita`, `usuario_id`, `titulo`, `descricao`, `tempo_preparo`, `porcoes`, `cadastrada_em`, `foto`, `historia`) VALUES
(1, 1, 'Cheesecake', 'Ingredientes:\r\n- Para a massa\r\n160g de biscoito maisena moído\r\n80g de manteiga derretida\r\n1/2 colher de chá de canela\r\n- Para o recheio\r\n690g de cream cheese\r\n180g de açúcar refinado\r\n1 colher de sopa de essência de baunilha\r\n1 colher de sopa de suco de limão\r\n3 ovos\r\n\r\nModo de preparo\r\n- Para a massa\r\n1º passo\r\n\r\nBata o biscoito no Mini Processador de Alimentos KitchenAid até virar uma farofa.\r\n\r\n2º passo\r\n\r\nAcrescente a manteiga derretida e bata na sua Stand Mixer, misturando bem.\r\n\r\n3º passo\r\n\r\nForre com a massa o fundo de uma forma de 20 cm, de fundo removível, e reserve.\r\n\r\n- Para o recheio\r\n1º passo\r\n\r\nBata o cream cheese na Stand Mixer até amaciar bem e aos poucos adicione o açúcar em velocidade baixa.\r\n\r\n2º passo\r\n\r\nPare de bater, acrescente a baunilha, o suco de limão e os ovos e bata até incorporar completamente.\r\n\r\n3º passo\r\n\r\nDespeje o recheio na forma forrada e asse por 15 minutos a 150ºC.\r\n\r\n4º passo\r\n\r\nApós esse período, reduza a temperatura para 100ºC e mantenha no forno por mais 30 minutos.\r\n\r\n5º passo\r\n\r\nPor fim, leve para gelar.\r\n', 60, 8, '2026-04-15', '69a4b00010ada.jpeg', NULL),
(3, 5, 'Carbonara', 'Ingredientes:\r\n\r\n200g de espaguete\r\n150g de bacon em cubos\r\n2 ovos grandes\r\n50g de queijo parmesão ralado\r\n1 dente de alho (opcional)\r\nSal a gosto\r\nPimenta-do-reino a gosto\r\n\r\nModo de preparo:\r\nCozinhe o espaguete em água fervente com sal até ficar al dente. Enquanto isso, frite o bacon em fogo médio até dourar e ficar levemente crocante. Se quiser, adicione o alho para dar mais sabor.\r\nEm um recipiente, bata os ovos com o parmesão e a pimenta.\r\nEscorra o macarrão e, ainda quente, misture com o bacon. Desligue o fogo e adicione a mistura de ovos, mexendo rapidamente para formar um molho cremoso sem cozinhar demais os ovos.', 25, 2, '2026-04-15', '69dd959d78bf1.png', 'Para mim essa receita é mais do que um prato — é um ritual de conexão com a bisavó. Ele lembra de ficar na cozinha observando cada movimento, enquanto o cheiro do bacon invadia a casa. Era sempre um momento de conversa, risadas e aprendizado. Hoje, sempre que ele prepara carbonara, revive esses domingos tranquilos e cheios de afeto.'),
(4, 5, 'Arroz e Feijão', 'Ingredientes:\r\n1 xícara de arroz\r\n2 xícaras de água\r\n1 xícara de feijão\r\n3 xícaras de água para o feijão\r\n2 dentes de alho picados\r\n2 colheres de sopa de óleo\r\nSal a gosto\r\n\r\nModo de preparo:\r\nCozinhe o feijão na panela de pressão por cerca de 25 minutos. Reserve.\r\nEm outra panela, refogue o alho no óleo, adicione o arroz e misture bem. Acrescente a água e o sal, cozinhe até secar.\r\nFinalize temperando o feijão a gosto.', 45, 4, '2026-04-15', '69dd95f3bfb42.png', 'Vejo nesse prato o verdadeiro significado de lar. Não é sofisticado, mas está presente em todos os momentos importantes da sua vida. Lembro da família reunida ao redor da mesa, conversando sobre o dia, com o cheiro do feijão recém feito trazendo conforto. Para mim, essa simplicidade carrega o maior valor: estar junto.'),
(5, 5, 'Pastel de Frango', 'Ingredientes:\r\n500g de massa de pastel\r\n300g de frango cozido e desfiado\r\n1/2 cebola picada\r\n1 colher de sopa de óleo\r\n3 colheres de sopa de requeijão\r\nSal e pimenta a gosto\r\nÓleo para fritar\r\n\r\nModo de preparo:\r\nRefogue a cebola no óleo até dourar. Adicione o frango desfiado, tempere e misture o requeijão.\r\nColoque o recheio na massa, feche bem com um garfo e frite em óleo quente até dourar. Escorra em papel toalha.', 35, 5, '2026-04-15', '69dd962c6f7b6.png', 'Lembro das manhãs de domingo na feira, onde o pastel era sempre a primeira parada. Comer aquele pastel quente, com caldo de cana, ao lado da família, virou uma memória afetiva inesquecível. Hoje, fazer pastel em casa é uma forma de reviver esses momentos simples e felizes com o meu pai.'),
(6, 5, 'Yakissoba', 'Ingredientes:\r\n250g de macarrão para yakissoba\r\n200g de frango em tiras\r\n1 cenoura em rodelas\r\n1/2 brócolis\r\n1/2 pimentão\r\n1/2 cebola\r\n4 colheres de sopa de molho shoyu\r\n1 colher de sopa de óleo\r\n1/2 xícara de água\r\n\r\nModo de preparo:\r\nCozinhe o macarrão e reserve.\r\nRefogue o frango no óleo até dourar. Adicione os legumes e mexa bem. Acrescente o shoyu e a água, deixando cozinhar levemente.\r\nMisture o macarrão e finalize.', 30, 4, '2026-04-15', '69dd968445654.png', 'Na minha família o yakissoba representa união. Era sempre preparado em momentos especiais, quando a família se reunia para cozinhar junta. Cada um ajudava de um jeito — cortando legumes, mexendo a panela — e isso transformava a refeição em um momento de conexão e carinho.'),
(7, 5, 'Strogonoff de Frango', 'Ingredientes:\r\n500g de peito de frango em cubos\r\n1/2 cebola picada\r\n2 colheres de sopa de manteiga\r\n1 caixa de creme de leite\r\n3 colheres de sopa de molho de tomate\r\n100g de champignon\r\nSal e pimenta a gosto\r\n\r\nModo de preparo:\r\nRefogue a cebola na manteiga, adicione o frango e doure bem.\r\nAcrescente o molho de tomate e os champignons.\r\nFinalize com o creme de leite, misture e desligue o fogo.', 30, 4, '2026-04-15', '69dd96efa5f6c.png', 'Associo esse prato à minha mãe. Ela sempre cozinhou para mim, desde quando a gente morava junto quanto quando passei a visitá-la. É um prato repleto de amor e carinho.'),
(8, 6, 'Massa com Molho Branco', 'Ingredientes:\r\n250g de macarrão\r\n2 colheres de sopa de manteiga\r\n2 colheres de sopa de farinha\r\n500ml de leite\r\n50g de queijo ralado\r\nSal e noz-moscada a gosto\r\n\r\nModo de preparo:\r\nCozinhe o macarrão.\r\nDerreta a manteiga, adicione a farinha e mexa bem. Acrescente o leite aos poucos até formar um molho.\r\nTempere e finalize com queijo. Misture ao macarrão.', 25, 3, '2026-04-15', '69dd9843ead54.png', 'Arthur lembra da primeira vez que tentou cozinhar sozinho. Era um desafio, mas também um momento de descoberta. O molho branco virou símbolo de independência e crescimento, além de um prato que sempre traz conforto.'),
(9, 6, 'Arroz, Bife e Batata Frita', 'Ingredientes:\r\n1 xícara de arroz\r\n2 xícaras de água\r\n3 bifes de carne (alcatra ou coxão mole)\r\n3 batatas médias cortadas em palito\r\n2 dentes de alho\r\nÓleo para fritar\r\nSal a gosto\r\n\r\nModo de preparo:\r\nCozinhe o arroz normalmente com alho e sal. Tempere os bifes com sal e alho e frite em uma frigideira até dourar dos dois lados.\r\nFrite as batatas em óleo quente até ficarem crocantes e douradas. Sirva tudo junto.', 40, 3, '2026-04-15', '69dd9879d91a6.png', 'Esse é o clássico prato que nunca falha. Lucas lembra de chegar da escola com fome e encontrar esse almoço pronto na mesa. Era simples, mas cheio de cuidado. Cada garfada traz a lembrança da rotina, do carinho e da segurança de saber que sempre havia alguém esperando por ele em casa.'),
(10, 6, 'Hot de Salmão', 'Ingredientes:\r\n2 xícaras de arroz japonês\r\n2 e 1/2 xícaras de água\r\n200g de salmão\r\n1 folha de alga nori\r\n100g de cream cheese\r\n1 xícara de farinha panko\r\n2 ovos\r\nÓleo para fritar\r\n\r\nModo de preparo:\r\nCozinhe o arroz japonês e deixe esfriar.\r\nAbra a alga, espalhe o arroz e adicione o salmão e o cream cheese. Enrole formando um rolinho.\r\nPasse no ovo batido e depois na farinha panko. Frite em óleo quente até dourar e corte em pedaços.', 50, 4, '2026-04-15', '69dd98ad77096.png', 'Para Nicoly, essa receita marca momentos especiais com amigos. Fazer sushi em casa virou uma tradição divertida, cheia de risadas e tentativas (nem sempre perfeitas). O importante nunca foi acertar o formato, mas sim aproveitar o momento juntos.'),
(11, 6, 'Escondidinho de Carne', 'Ingredientes:\r\n500g de carne moída\r\n5 batatas médias\r\n2 colheres de sopa de manteiga\r\n1/2 xícara de leite\r\n1/2 cebola picada\r\n2 dentes de alho\r\n150g de queijo ralado\r\nSal a gosto\r\n\r\nModo de preparo:\r\nCozinhe as batatas, amasse e misture com manteiga e leite formando um purê.\r\nRefogue a cebola e o alho, adicione a carne e tempere.\r\nEm um refratário, faça uma camada de purê, depois carne, e finalize com mais purê e queijo. Leve ao forno até gratinar.', 50, 4, '2026-04-10', '69dd98d48055f.png', 'Leonardo lembra que esse prato sempre aparecia em dias especiais. Era o tipo de comida que reunia todos na mesa e fazia o tempo passar mais devagar. O escondidinho, para ele, é sinônimo de conforto e de família reunida.'),
(12, 6, 'Lasanha de Frango', 'Ingredientes:\r\n500g de massa de lasanha\r\n400g de frango desfiado\r\n1 sachê de molho de tomate\r\n200g de queijo mussarela\r\n1/2 cebola\r\n2 dentes de alho\r\nSal a gosto\r\n\r\nModo de preparo:\r\nRefogue a cebola e o alho, adicione o frango e o molho.\r\nMonte camadas de massa, frango e queijo. Repita até finalizar.\r\nLeve ao forno por cerca de 30 minutos.', 60, 6, '2026-04-10', '69dd98fb9be17.png', 'Arthur associa essa receita aos almoços de domingo, quando a família se reunia sem pressa. Era aquele tipo de refeição que começava na cozinha, com todo mundo ajudando, e terminava em uma mesa cheia de conversa e risadas.'),
(13, 6, 'Almôndegas', 'Ingredientes:\r\n500g de carne moída\r\n1 ovo\r\n3 colheres de sopa de farinha de rosca\r\n2 dentes de alho\r\nSal e pimenta a gosto\r\n1 xícara de molho de tomate\r\n\r\nModo de preparo:\r\nMisture todos os ingredientes, modele as bolinhas e frite até dourar.\r\nDepois, finalize cozinhando no molho de tomate.', 40, 7, '2026-04-10', '69dd9925c2c7f.png', 'Essa receita carrega tradição. Passada de geração em geração, cada pessoa da família tem sua forma de fazer, mas o sabor sempre traz a mesma sensação: pertencimento e memória.'),
(14, 6, 'Espaguete à Bolonhesa', 'Ingredientes:\r\n250g de espaguete\r\n400g de carne moída\r\n1 sachê de molho de tomate\r\n1/2 cebola\r\n2 dentes de alho\r\nSal a gosto\r\n\r\nModo de preparo:\r\nCozinhe o macarrão.\r\nRefogue a cebola e o alho, adicione a carne e depois o molho.\r\nMisture tudo e sirva.', 35, 4, '2026-04-10', '69dd994c077b9.png', 'Márcia lembra de uma casa sempre cheia, com o cheiro do molho cozinhando por horas. Era o tipo de prato que reunia todo mundo, onde cada refeição virava uma celebração simples, mas muito especial.'),
(15, 7, 'Pizza de Carne de Panela', 'Ingredientes:\r\n1 massa de pizza pronta\r\n300g de carne de panela desfiada\r\n200g de queijo mussarela\r\n1/2 xícara de molho de tomate\r\n\r\nModo de preparo:\r\nEspalhe o molho na massa, adicione a carne e o queijo.\r\nLeve ao forno até o queijo derreter.', 30, 8, '2026-04-10', '69dd9a14bf9a9.png', 'Essa receita nasceu do improviso. Lucas conta que era uma forma criativa de reaproveitar sobras, mas acabou virando uma das favoritas da família — prova de que as melhores ideias surgem sem planejamento.'),
(16, 7, 'Tacos da Nonna', 'Ingredientes:\r\n6 tortilhas\r\n300g de carne moída\r\n1/2 cebola\r\n1 tomate picado\r\n100g de queijo\r\nSal a gosto\r\n\r\nModo de preparo:\r\nRefogue a carne com a cebola e tempere.\r\nMonte os tacos com carne, tomate e queijo.', 25, 3, '2026-04-10', '69dd9a45f17ea.png', 'Chamo de “tacos da nonna” porque mistura influências da família italiana com sabores diferentes. É uma receita que representa adaptação e criatividade dentro da tradição.'),
(17, 7, 'Parmegiana', 'Ingredientes:\r\n4 bifes\r\n2 ovos\r\n1 xícara de farinha de rosca\r\n1 xícara de molho de tomate\r\n150g de queijo\r\n3 dentes de alho\r\nSal a gosto\r\n\r\nModo de preparo:\r\nTempere os bifes, passe no ovo e na farinha e frite.\r\nPara parmegiana: cubra com molho e queijo e leve ao forno.', 45, 4, '2026-04-10', '69dd9a6a8e933.png', 'Claudio lembra do cheiro forte do alho na cozinha da avó. Era impossível não saber quando o almoço estava chegando. Essa receita carrega esse aroma marcante que, para ele, significa família.'),
(18, 7, 'Carne Assada', 'Ingredientes:\r\n1kg de carne (coxão mole ou alcatra)\r\n4 dentes de alho\r\nSal grosso a gosto\r\n2 colheres de sopa de óleo\r\n\r\nModo de preparo:\r\nTempere a carne e leve ao forno por cerca de 1h30, virando na metade do tempo.', 90, 6, '2026-04-10', '69dd9a890d57f.png', 'William associa essa receita aos finais de semana em família, quando todos se reuniam sem pressa. O cheiro da carne assando era o sinal de que o dia seria de descanso, conversa e união.'),
(19, 7, 'Bolinho de Chuva', 'Ingredientes:\r\n2 xícaras de farinha de trigo\r\n1/2 xícara de açúcar\r\n1 xícara de leite\r\n1 ovo\r\n1 colher de sopa de fermento em pó\r\nÓleo para fritar\r\nAçúcar e canela para polvilhar\r\n\r\nModo de preparo:\r\nEm um recipiente, misture o ovo, o leite e o açúcar. Acrescente a farinha aos poucos até formar uma massa homogênea. Por último, adicione o fermento.\r\nCom uma colher, pegue pequenas porções da massa e frite em óleo quente até dourar. Retire e passe no açúcar com canela.', 25, 20, '2026-04-10', '69dd9b82101b1.png', 'Eu sempre lembro dos dias de chuva, quando ficar em casa era quase um convite para ir pra cozinha. Minha família preparava bolinho de chuva enquanto o som da água batendo na janela criava um clima aconchegante. Eu ficava esperando ansiosamente o primeiro sair, ainda quentinho, com açúcar e canela. Até hoje, fazer essa receita é como trazer de volta esses momentos de conforto e tranquilidade.'),
(20, 7, 'Cuscuz com Bacon e Ovo', 'Ingredientes:\r\n1 xícara de flocão de milho\r\n1/2 xícara de água\r\n1 pitada de sal\r\n100g de bacon em cubos\r\n2 ovos\r\n1 colher de sopa de manteiga\r\n\r\nModo de preparo:\r\nHidrate o flocão com a água e o sal por alguns minutos. Cozinhe no vapor até ficar macio.\r\nFrite o bacon até dourar. Em outra panela, prepare os ovos (mexidos ou fritos).\r\nSirva o cuscuz com manteiga, bacon e ovos por cima.', 20, 2, '2026-04-10', '69dd9b9d61275.png', 'Eu aprendi a gostar de cuscuz nos cafés da manhã em família, quando acordar cedo valia a pena só pelo cheiro vindo da cozinha. O bacon estalando na frigideira e o ovo sendo preparado na hora deixavam tudo ainda mais especial. Esse prato, pra mim, representa começo de dia com carinho e energia.'),
(21, 8, 'Pudim de Leite', 'Ingredientes:\r\n1 lata de leite condensado\r\n2 medidas (da lata) de leite\r\n3 ovos\r\n1 xícara de açúcar (para a calda)\r\n\r\nModo de preparo:\r\nDerreta o açúcar em uma forma até virar caramelo e espalhe bem.\r\nBata no liquidificador o leite condensado, o leite e os ovos.\r\nDespeje na forma e leve ao forno em banho-maria por cerca de 1 hora. Deixe esfriar e desenforme.', 80, 8, '2026-04-10', '69dd9c5aa2257.png', 'Esse pudim sempre vai ser, pra mim, o gosto da minha mãe. Eu lembro dela preparando tudo com calma, enquanto eu ficava por perto esperando poder raspar o restinho da mistura. Era o doce das ocasiões especiais, mas também aparecia em dias comuns só pra deixar tudo melhor. Até hoje, quando faço essa receita, sinto como se estivesse revivendo esses momentos ao lado dela.'),
(22, 8, 'Pão de Queijo', 'Ingredientes:\r\n2 xícaras de polvilho doce\r\n1 xícara de queijo minas ralado\r\n1/2 xícara de leite\r\n1/4 xícara de óleo\r\n1 ovo\r\n1 pitada de sal\r\n\r\nModo de preparo:\r\nAqueça o leite com o óleo e despeje sobre o polvilho. Misture bem.\r\nAdicione o ovo, o queijo e o sal, mexendo até formar uma massa.\r\nModele bolinhas e leve ao forno a 180°C por cerca de 25 minutos.', 30, 20, '2026-04-10', '69dd9c774d674.png', 'Eu sempre associo pão de queijo ao cheiro que toma conta da casa inteira. É impossível não ficar esperando na frente do forno. Na minha família, ele sempre aparece nos momentos mais simples — um café da tarde, uma visita inesperada — e transforma qualquer situação em algo especial.'),
(23, 8, 'Muffin de Chocolate com Frutas Vermelhas', 'Ingredientes:\r\n1 xícara de farinha de trigo\r\n1/2 xícara de açúcar\r\n1/3 xícara de cacau em pó\r\n1/2 xícara de leite\r\n1/4 xícara de óleo\r\n1 ovo\r\n1 colher de chá de fermento\r\n1/2 xícara de frutas vermelhas\r\n\r\nModo de preparo:\r\nMisture os ingredientes líquidos e depois os secos. Acrescente as frutas por último.\r\nDistribua em forminhas e asse a 180°C por cerca de 25 minutos.', 30, 8, '2026-04-10', '69dd9c9472382.png', 'Eu gosto dessa receita porque ela mistura o doce do chocolate com o leve azedinho das frutas, criando algo equilibrado e especial. É um tipo de receita que eu faço quando quero me cuidar, desacelerar e aproveitar um momento só meu.'),
(24, 8, 'Torrada de abacate e bacon', 'Ingredientes:\r\n2 fatias de pão\r\n1/2 abacate\r\n4 fatias de bacon\r\nSuco de 1/2 limão\r\nSal e pimenta a gosto\r\n\r\nModo de preparo:\r\nAmasse o abacate com limão, sal e pimenta.\r\nToste o pão. Frite o bacon até ficar crocante.\r\nMonte espalhando o abacate no pão e colocando o bacon ao lado cima.', 15, 2, '2026-04-10', '69dd9cdec06d8.png', 'Essa receita representa um momento mais atual da minha vida, quando comecei a experimentar coisas novas na cozinha. É simples, mas cheia de personalidade. Eu gosto de preparar quando quero algo rápido, mas que ainda assim me faça sentir que estou cuidando de mim.'),
(25, 2, 'Brigadeiro da Neiloca', 'Ingredientes:\r\n1 lata (395g) de leite condensado\r\n1 colher de sopa de manteiga\r\n1 colher de sopa de café solúvel (ou 2 colheres de café forte já pronto)\r\n2 colheres de sopa de chocolate em pó (ou cacau 50%)\r\n1/2 caixa de creme de leite (opcional, para deixar mais cremoso)\r\nChocolate granulado ou cacau em pó para enrolar\r\n\r\nModo de preparo:\r\nEm uma panela, coloque o leite condensado, a manteiga, o café e o chocolate em pó. Misture bem antes de levar ao fogo.\r\nCozinhe em fogo baixo, mexendo sempre, até a mistura desgrudar do fundo da panela (ponto de brigadeiro).\r\nSe quiser mais cremoso, desligue o fogo e misture o creme de leite.\r\nDeixe esfriar, unte as mãos com manteiga, enrole e passe no granulado ou no cacau.', 20, 15, '2026-04-15', '69dd9ddadfdaf.png', 'Eu sempre associei café a conversa. Na minha casa, ele nunca foi só uma bebida — era o momento de sentar, respirar e compartilhar o dia. Esse brigadeiro de café nasceu exatamente disso: da vontade de transformar esse momento em algo doce, mas sem perder a essência. Eu lembro de preparar essa receita pela primeira vez em uma tarde tranquila, com o cheiro de café espalhado pela casa. Cada mordida me lembra essas pausas simples, cheias de significado, onde o mais importante não era o doce em si, mas a companhia e o tempo compartilhado.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `receita_categorias`
--

CREATE TABLE `receita_categorias` (
  `id_receita_categoria` int(11) NOT NULL,
  `receita_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `receita_categorias`
--

INSERT INTO `receita_categorias` (`id_receita_categoria`, `receita_id`, `categoria_id`) VALUES
(1, 1, 3),
(3, 3, 4),
(4, 4, 2),
(5, 5, 1),
(6, 6, 2),
(7, 7, 2),
(8, 8, 4),
(9, 9, 2),
(10, 10, 4),
(11, 11, 2),
(12, 12, 2),
(13, 13, 2),
(14, 14, 2),
(15, 15, 4),
(16, 16, 3),
(17, 17, 2),
(18, 18, 4),
(19, 19, 3),
(20, 20, 1),
(21, 21, 3),
(22, 22, 3),
(23, 23, 3),
(24, 24, 1),
(25, 25, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` date NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `foto_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `criado_em`, `endereco`, `bairro`, `cidade`, `estado`, `cep`, `foto_url`) VALUES
(1, 'LUIZA MARINHO MATTE', 'luizamarinhomatte@gmail.com', '$2y$10$p.HOAxczcb162lXmgWdY0e7dnj/R513PShCqtpATDtMG1BfqU9UkO', '2026-03-01', 'Rua Marcílio Dias', NULL, 'Porto Alegre', NULL, '90130-001', NULL),
(2, 'Fer', 'fer@gmail.com', '$2y$10$/s2F9Fuqwj.xXLiNPlqNYehbHIRpbeCFo9J3O/AHdikCBLjCNQgDq', '2026-03-01', 'Rua Marcílio Dias', NULL, 'Porto Alegre', NULL, '90130-001', NULL),
(4, 'Neila', 'neila@hotmail.com', '$2y$10$tR5uJYPjyoecYSGprgYPDe5r5liiDcsdU5vY8E7p/lfUfNnnjYcky', '2026-04-13', 'Rua Marcílio Dias', NULL, 'Porto Alegre', NULL, '90130001', NULL),
(5, 'Fernanda M. Matte', 'fer_matte@hotmail.com', '$2y$10$ko01v04UcEjCJO6xhQP5YuNzgJGTQ.MJA1rNX1nxCOzmwCAhe2HZe', '2026-04-13', 'Rua Marcílio Dias, 517', NULL, 'Porto Alegre', NULL, '90130001', NULL),
(6, 'Marcelo De David', 'marcelo@hotmail.com', '$2y$10$MZ0R8D.rO27e8gqbgaq3fONvrurCbURvU5SWY1u2r2MVyxdh9b6ve', '2026-04-14', 'Rua da Consolação', NULL, 'São Paulo', NULL, '01416-000', NULL),
(7, 'Leonardo Stirmer', 'leo@hotmail.com', '$2y$10$7qulbXph4eWv7TxgH4h3Wu6FsdNa7S2wwEiBBt.UvEsZsKO2wJ4Xe', '2026-04-14', 'Avenida das Nações Unidas', NULL, 'São Paulo', NULL, '04795-000', NULL),
(8, 'Márcia Flores', 'marcia@gmail.com', '$2y$10$nR0Zw476T9o1nQG8vtS04u6ldsPBePwfw8ia2NzYfqDbbkNingsWe', '2026-04-14', 'Avenida Ipiranga', NULL, 'Porto Alegre', NULL, '90619-900', NULL),
(9, 'Leda Cezimbra', 'lecezimbra@gmail.com', '$2y$10$M3mqiazFwza1tn1l5TPRSu8rO51yUtFeDm7oPX6yRVutc1/MbL4Ni', '2026-04-15', 'Rodovia Municipal Francisco Wollinger', NULL, 'Governador Celso Ramos', NULL, '88190-001', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `receita_id` (`receita_id`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favorito`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`receita_id`),
  ADD KEY `receita_id` (`receita_id`);

--
-- Índices de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id_ingrediente`);

--
-- Índices de tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id_receita`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `receita_categorias`
--
ALTER TABLE `receita_categorias`
  ADD PRIMARY KEY (`id_receita_categoria`),
  ADD KEY `receita_id` (`receita_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id_ingrediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id_receita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `receita_categorias`
--
ALTER TABLE `receita_categorias`
  MODIFY `id_receita_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`receita_id`) REFERENCES `receitas` (`id_receita`);

--
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`receita_id`) REFERENCES `receitas` (`id_receita`) ON DELETE CASCADE;

--
-- Restrições para tabelas `receitas`
--
ALTER TABLE `receitas`
  ADD CONSTRAINT `receitas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `receita_categorias`
--
ALTER TABLE `receita_categorias`
  ADD CONSTRAINT `receita_categorias_ibfk_1` FOREIGN KEY (`receita_id`) REFERENCES `receitas` (`id_receita`),
  ADD CONSTRAINT `receita_categorias_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
