// Подключаем конфетти и инициализируем колесо
const confettiScript = document.createElement("script");
confettiScript.src =
  "https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js";
confettiScript.onload = initWheel;
document.head.appendChild(confettiScript);

async function initWheel() {
  const wheel = document.querySelector(".wheel");
  const center = document.querySelector(".center-circle");
  const sectors = Array.from(document.querySelectorAll('g[class^="sector-"]'));

  if (!wheel || !center || sectors.length !== 12) return;

  const SECTOR_COUNT = sectors.length;
  const SECTOR_ANGLE = 360 / SECTOR_COUNT;
  const POINTER_INDEX = 9; // стрелка на 10-й сектор

  let rotation = 0;
  let spinning = false;
  let idleTimer;
  let idleActive = true;

  center.classList.add("pulse");

  // ===== IDLE-анимация: +30 -> -15 =====
  function startIdle() {
  idleActive = true;
  let currentForward = true;
  const forwardDeg = 30;
  const backwardDeg = 15;

  function step() {
    if (!idleActive || spinning) return;

    if (currentForward) {
      // вперед
      wheel.style.transition = "transform 1.2s ease-out";
      rotation += forwardDeg;
      wheel.style.transform = `rotate(${rotation}deg)`;

      currentForward = false;
      setTimeout(step, 1200); // ждем окончания движения вперед
    } else {
      // назад
      wheel.style.transition = "transform 1.0s ease-in-out";
      rotation -= backwardDeg;
      wheel.style.transform = `rotate(${rotation}deg)`;

      currentForward = true;
      setTimeout(step, 1000); // ждем окончания движения назад
    }
  }

  step(); // запускаем первый шаг
}


  function stopIdle() {
    idleActive = false;
    clearInterval(idleTimer);
  }

function normalizeRotation() {
    rotation = ((rotation % 360) + 360) % 360;
    wheel.style.transition = "none";
    wheel.style.transform = `rotate(${rotation}deg)`;
  
}
  // ===== Загрузка данных =====
  async function loadProbabilities() {
    try {
      const res = await fetch("probabilities.php");
      const data = await res.json();
      return sectors.map((_, i) => {
        const found = data.find(d => Number(d.id) === i + 1);
        return found ? Number(found.probability) : 1;
      });
    } catch {
      return Array(SECTOR_COUNT).fill(1);
    }
  }

  async function loadSpinCount() {
    try {
      const res = await fetch("wheel_settings.php");
      const data = await res.json();
      return Number(data.spin_count) || 10;
    } catch {
      return 10;
    }
  }

  function pickByProbability(probs) {
    const sum = probs.reduce((a, b) => a + b, 0);
    let r = Math.random() * sum;
    for (let i = 0; i < probs.length; i++) {
      r -= probs[i];
      if (r <= 0) return i;
    }
    return probs.length - 1;
  }

  // ===== СПИН =====
  async function spinWheel() {
    if (spinning) return;
    spinning = true;

    stopIdle();
    normalizeRotation();
    center.classList.remove("pulse");

    // микроподъезд +10° и сразу назад
    wheel.style.transition = "transform 0.2s ease-out";
    wheel.style.transform = `rotate(${rotation}deg)`;

    setTimeout(() => {
      wheel.style.transition = "transform 0.2s ease-in";
      wheel.style.transform = `rotate(${rotation}deg)`;
    }, 200);

    // основной спин после микроподъезда
    setTimeout(async () => {
      const spinCount = await loadSpinCount();
      const probs = await loadProbabilities();
      const winnerIndex = pickByProbability(probs);

      const pointerAngle = POINTER_INDEX * SECTOR_ANGLE;
      const targetAngle = winnerIndex * SECTOR_ANGLE;

      let delta = pointerAngle - (rotation % 360 + targetAngle);
      delta = ((delta % 360) + 360) % 360;

      const finalRotation = rotation + spinCount * 360 + delta;

      // основной спин с плавным easing
      wheel.style.transition =
        "transform 5s cubic-bezier(0.25, 0.1, 0.25, 1)";
      wheel.style.transform = `rotate(${finalRotation + 10}deg)`; // чуть вперед

      // финальная фиксация и конфетти
      setTimeout(() => {
        wheel.style.transition = "transform 0.5s ease-in-out";
        wheel.style.transform = `rotate(${finalRotation}deg)`; // возвращаем

        rotation = finalRotation % 360;

        sectors.forEach(s => s.classList.remove("active"));
        sectors[winnerIndex].classList.add("active");

        if (typeof confetti === "function") {
          confetti({ particleCount: 150, spread: 70, origin: { y: 0.6 } });
        }

        // переход на страницу победного сектора
        setTimeout(() => {
          window.location.href = `../php/card.php?sector=${winnerIndex + 1}`;
        }, 1200);

        spinning = false;
       
      }, 5200);
    }, 420);
  }

  // ===== СТАРТ =====
  startIdle();
  wheel.addEventListener("click", spinWheel);
  center.addEventListener("click", spinWheel);
}
