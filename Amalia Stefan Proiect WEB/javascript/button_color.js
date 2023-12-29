  // Lista de culori
  const colors = ['#EAECCC', '#DBCC95', '#C3E2C2', '#CD8D7A'];

  // Selectăm toate butoanele
  const buttons = document.querySelectorAll('.btn');

  // Pentru fiecare buton, schimbăm culoarea cu una aleatoare din lista de culori
  buttons.forEach(button => {
    const randomColor = colors[Math.floor(Math.random() * colors.length)];
    button.style.backgroundColor = randomColor;
  });