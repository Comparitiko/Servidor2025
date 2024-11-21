import canvasConfetti from 'https://cdn.jsdelivr.net/npm/canvas-confetti@1.9/+esm'

const video = document.querySelector('.video')

const konamiCode = ['k', 'a', 'm', 'e', 'h', 'a', 'm', 'e', 'h', 'a']
let tryKC = []

document.addEventListener('keydown', (e) => {
  for (let i = 0; i < konamiCode.length; i++) {
    if (!tryKC[i] && konamiCode[i] === e.key) {
      tryKC.push(e.key)
      break
    } else if (tryKC[i] !== konamiCode[i]) {
      tryKC = []
      console.log('Konami code limpiado, el codigo es: "' + konamiCode.join('') + '",')
      break
    }
  }
  if (konamiCode.join('') === tryKC.join('')) {
    video.classList.toggle('playing')
    canvasConfetti({
      spread: 300,
      gravity: 0.5,
    })
    video.play()
    tryKC = []
    video.addEventListener('ended', () => {
      video.classList.toggle('playing')
    })
  }
})