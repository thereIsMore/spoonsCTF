function generateRandomInteger(min, max) {
    return Math.floor(min + Math.random()*(max - min + 1))
  }

function run() {
    document.querySelectorAll('.spoon').forEach(stopBeingNosey => {
     
        stopBeingNosey.style.left = generateRandomInteger(100, window.screen.width-100) + 'px'
        stopBeingNosey.style.top = generateRandomInteger(100, window.screen.height-100) + 'px'
        stopBeingNosey.addEventListener('click', function(e) {
            iveBeenSpooned(e.target)
        });
    })
}

function iveBeenSpooned(t) {

    if (spoonsss.includes(t)) {
        alert("You can't spoon me twice")
        return
    }

    spoons += 1
    console.log(spoons)
    spoonsss.push(t)

    if (parseInt(spoons) === parseInt(atob(atob(document.getElementById("d").getAttribute("v"))))) {
        alert('SPOONS often SPOONS angel SPOONS beam SPOONS')
        window.location.href = './spoon.html'
    }

}

let spoons = 0;
let spoonsss = []

window.onload = run()