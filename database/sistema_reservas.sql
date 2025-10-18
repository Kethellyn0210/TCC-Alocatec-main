CREATE DATABASE sistema_reservas;
USE sistema_reservas;
 
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    rg VARCHAR(20) NOT NULL,
    endereco VARCHAR(150) NOT NULL
);
 
CREATE TABLE espaco (
    id_espaco INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL,
    capacidade INT NOT NULL,
    localidade VARCHAR(100) NOT NULL,
    status ENUM('disponível', 'indisponível') NOT NULL,
    id_estabelecimento INT NOT NULL,
    
    FOREIGN KEY (id_estabelecimento) REFERENCES estabelecimento(id_estabelecimento)
);
 
CREATE TABLE administrador (
    id_administrador INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    endereco VARCHAR(150) NOT NULL
);
 
CREATE TABLE estabelecimento (
    id_estabelecimento INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(150) NOT NULL,
    id_administrador INT NOT NULL
);
 
CREATE TABLE reserva (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    horario TIME NOT NULL,
    status ENUM('pendente', 'concluída', 'cancelada') NOT NULL,
    id_usuario INT NOT NULL,
    id_espaco INT NOT NULL,
    id_administrador INT NOT NULL,
 
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_espaco) REFERENCES espaco(id_espaco),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador)
);

INSERT INTO administrador (nome, email, telefone, endereco) VALUES
('Ana Souza', 'ana@admin.com', '11987654321', 'Rua das Flores, 100'),
('Carlos Pereira', 'carlos@admin.com', '11999887766', 'Av. Central, 200'),
('Marcos Lima', 'marcos@admin.com', '11911223344', 'Rua Azul, 50'),
('Patrícia Gomes', 'patricia@admin.com', '11922334455', 'Av. Verde, 75'),
('Renato Alves', 'renato@admin.com', '11933445566', 'Rua Vermelha, 33'),
('Juliana Costa', 'juliana@admin.com', '11944556677', 'Av. Laranja, 88'),
('Eduardo Santos', 'eduardo@admin.com', '11955667788', 'Rua Amarela, 101'),
('Fernanda Melo', 'fernanda@admin.com', '11966778899', 'Av. Roxa, 120'),
('Lucas Ribeiro', 'lucas@admin.com', '11977889900', 'Rua Rosa, 200'),
('Carla Martins', 'carla@admin.com', '11988990011', 'Av. Prata, 250');

INSERT INTO estabelecimento (nome, endereco, id_administrador) VALUES
('Centro Esportivo Zona Sul', 'Rua Verde, 123', 1),
('Arena Norte', 'Av. Paulista, 456', 2),
('Clube Leste', 'Rua Leste, 78', 3),
('Ginásio Central', 'Av. Central, 90', 4),
('Espaço Multiuso', 'Rua Nova, 12', 5),
('Academia Oeste', 'Av. Oeste, 33', 6),
('Pavilhão Sul', 'Rua do Sol, 44', 7),
('Estádio Norte', 'Av. das Estrelas, 55', 8),
('Complexo Central', 'Rua Principal, 66', 9),
('Auditório Principal', 'Av. da Liberdade, 77', 10);

INSERT INTO usuario (nome, email, telefone, rg, endereco) VALUES
('João Silva', 'joao@email.com', '11911112222', '1234567', 'Rua A, 10'),
('Maria Oliveira', 'maria@email.com', '11933334444', '7654321', 'Rua B, 20'),
('Pedro Santos', 'pedro@email.com', '11955556666', '9876543', 'Rua C, 30'),
('Juliana Costa', 'juliana@email.com', '11977778888', '1928374', 'Rua D, 40'),
('Lucas Almeida', 'lucas@email.com', '11988889999', '5647382', 'Rua E, 50'),
('Fernanda Lima', 'fernanda@email.com', '11999990000', '8372619', 'Rua F, 60'),
('Eduardo Rocha', 'eduardo@email.com', '11912121212', '1928374', 'Rua G, 70'),
('Carla Martins', 'carla@email.com', '11934343434', '9182736', 'Rua H, 80'),
('Rafael Souza', 'rafael@email.com', '11956565656', '5647382', 'Rua I, 90'),
('Patrícia Gomes', 'patricia@email.com', '11978787878', '8372619', 'Rua J, 100');

INSERT INTO espaco (tipo, capacidade, localidade, status, id_estabelecimento) VALUES
('Quadra de Futebol', 20, 'Pátio Principal', 'disponível', 1),
('Quadra de Vôlei', 12, 'Bloco B', 'disponível', 1),
('Sala de Reunião', 8, 'Bloco A - 2º andar', 'indisponível', 2),
('Auditório', 100, 'Bloco C', 'disponível', 2),
('Piscina', 30, 'Área Externa', 'disponível', 3),
('Campo de Tênis', 10, 'Bloco D', 'indisponível', 4),
('Sala de Treinamento', 15, 'Bloco E', 'disponível', 5),
('Ginásio Coberto', 50, 'Bloco F', 'disponível', 6),
('Quadra Poliesportiva', 25, 'Pátio Lateral', 'disponível', 7),
('Auditório Principal', 120, 'Bloco G', 'indisponível', 8);

INSERT INTO reserva (data, horario, status, id_usuario, id_espaco, id_administrador) VALUES
('2025-10-20', '10:00:00', 'pendente', 1, 1, 1),
('2025-10-21', '14:00:00', 'concluída', 2, 2, 1),
('2025-10-22', '09:30:00', 'pendente', 3, 3, 2),
('2025-10-23', '16:00:00', 'cancelada', 4, 4, 2),
('2025-10-24', '11:00:00', 'pendente', 5, 5, 3),
('2025-10-25', '15:30:00', 'concluída', 6, 6, 4),
('2025-10-26', '08:00:00', 'pendente', 7, 7, 5),
('2025-10-27', '13:00:00', 'cancelada', 8, 8, 6),
('2025-10-28', '10:30:00', 'concluída', 9, 9, 7),
('2025-10-29', '17:00:00', 'pendente', 10, 10, 8);