<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detroit Games | Adicionar Produto</title>
  <link rel="stylesheet" href="../public/css/adicionar.css" />

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- ===== HEADER ===== -->
  <header class="header">
    <div class="logo">
      <img src="../public/images/LogoSemFundo.png" alt="Logótipo da Detroit Games" onclick="window.location.href='../app/views/index.php'" style="cursor: pointer;" />
    </div>

   
  </header>

  <!-- ===== NAVBAR ===== -->
  <nav class="navbar">
    <ul>
      <li><a href="../public/roteador.php?controller=produto&action=listar">Produtos</a></li>
      <li><a href="../public/roteador.php?controller=produto&action=listar">Vendas</a></li>
      <li><a href="../public/roteador.php?controller=venda&action=historico">Histórico de Vendas</a></li>
    </ul>
  </nav>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="main-content">
    <!-- ===== BACKGROUND CAROUSEL ===== -->
    <div class="carousel">
      <div class="carousel-container">
        <div class="slide active">
          <img src="../public/images/carousel/GOW.jpg" alt="God of War Ragnarok" />
        </div>
        <div class="slide">
          <img src="../public/images/carousel/EldenRing.avif" alt="Elden Ring" />
        </div>
        <div class="slide">
          <img src="../public/images/carousel/DetroitBecomeHuman.jpg" alt="Detroit Become Human" />
        </div>
      </div>
    </div>

    <!-- ===== FORM CONTAINER ===== -->
    <div class="form-container">
      <h2><i class="fa fa-plus-circle"></i> Cadastrar Novo Produto</h2>

      <form action="../public/roteador.php?controller=produto&action=salvar" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
          <label for="nome"><i class="fa fa-gamepad"></i> Nome do Produto</label>
          <input type="text" id="nome" name="nome" placeholder="Ex: God of War Ragnarok" required>
        </div>

        <div class="form-group">
          <label for="desenvolvedora"><i class="fa fa-building"></i> Desenvolvedora</label>
          <input type="text" id="desenvolvedora" name="desenvolvedora" placeholder="Ex: Santa Monica Studio" required>
        </div>

        <div class="form-group">
          <label for="genero"><i class="fa fa-tags"></i> Gênero</label>
          <input type="text" id="genero" name="genero" placeholder="Ex: Ação, Aventura" required>
        </div>

        <div class="form-group">
          <label for="plataforma"><i class="fa fa-gamepad"></i> Plataforma</label>
          <select id="plataforma" name="plataforma" required>
            <option value="" disabled selected>Selecione uma plataforma</option>
            <option value="PS5">PlayStation 5</option>
            <option value="PS4">PlayStation 4</option>
            <option value="Xbox">Xbox</option>
            <option value="Nintendo">Nintendo</option>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group half">
            <label for="valor"><i class="fa fa-dollar-sign"></i> Valor</label>
            <input type="number" id="valor" name="valor" step="0.01" placeholder="Ex: 249.90" required>
          </div>

          <div class="form-group half">
            <label for="estoque"><i class="fa fa-boxes"></i> Estoque</label>
            <input type="number" id="estoque" name="estoque" placeholder="Ex: 10" required>
          </div>
        </div>

        <div class="form-group">
          <label for="imagem"><i class="fa fa-image"></i> Imagem do Produto</label>
          <input type="file" id="imagem" name="imagem" accept="image/jpeg, image/png, image/webp" required>
          <div id="preview"></div>
        </div>

        <button type="submit" class="form-button">
          <i class="fa fa-save"></i> Salvar Produto
        </button>
      </form>

      <a href="../public/roteador.php?controller=produto&action=listar" class="back-link">
        <i class="fa fa-arrow-left"></i> Voltar para a lista de produtos
      </a>
    </div>
  </main>

  <!-- ===== JS DO CARROSSEL ===== -->
  <script>
    let index = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showSlide(i) {
      slides.forEach((slide, idx) => {
        slide.classList.remove('active');
        if (idx === i) slide.classList.add('active');
      });
      document.querySelector('.carousel-container').style.transform = `translateX(-${i * 100}%)`;
    }

    setInterval(() => {
      index = (index + 1) % totalSlides;
      showSlide(index);
    }, 5000);

    const inputFile = document.querySelector("#imagem");
    const preview = document.querySelector("#preview");

    inputFile.addEventListener("change", () => {
      const file = inputFile.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          preview.innerHTML = `<img src="${e.target.result}" alt="Prévia da imagem">`;
        };
        reader.readAsDataURL(file);
      } else {
        preview.innerHTML = "";
      }
    });
  </script>
</body>
</html>
