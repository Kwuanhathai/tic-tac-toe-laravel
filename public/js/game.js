// ======= Global board =======
let board = [
    ['', '', ''],
    ['', '', ''],
    ['', '', '']
];

// ======= A function to reset the board =======
function resetBoard() {
    board = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];
    for(let x=0;x<3;x++){
        for(let y=0;y<3;y++){
            document.getElementById(`cell-${x}-${y}`).innerText='';
        }
    }
    document.getElementById('message').innerText='';
}

// ======= A function to check the winner =======
function checkWinner(b){
    // Rows
    for(let i=0;i<3;i++){
        if(b[i][0]!='' && b[i][0]==b[i][1] && b[i][1]==b[i][2]) return b[i][0];
    }
    // Columns
    for(let j=0;j<3;j++){
        if(b[0][j]!='' && b[0][j]==b[1][j] && b[1][j]==b[2][j]) return b[0][j];
    }
    // Diagonals
    if(b[0][0]!='' && b[0][0]==b[1][1] && b[1][1]==b[2][2]) return b[0][0];
    if(b[0][2]!='' && b[0][2]==b[1][1] && b[1][1]==b[2][0]) return b[0][2];

    return null;
}

// ======= The score starts from the database =======
let scoreEl = document.getElementById('score');
let score = parseInt(scoreEl?.innerText.replace('Score:','')) || 0;
let streak = 0;

function updateScoreUI(){
    if(scoreEl) scoreEl.innerText = `Score: ${score}`;
}

// ======= Send the score and the winner to the server =======
function sendScoreToServer(winner) {
    fetch('/game/score', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ winner: winner })
    })
    .then(response => response.json())
    .then(data => {
        // Update the score and streak based on the values retrieved from the database
        score = data.score;
        streak = data.streak;
        updateScoreUI();
    })
    .catch(err => console.error(err));
}

// ======= Display the winner =======
function showWinner(winner){
    const msgEl = document.getElementById('message');

    if(winner=='X'){
        score += 1;
        streak += 1;
        if(streak === 3){
            score += 1;
            streak = 0;
        }
        msgEl.innerText='🎉 You Win!';
        msgEl.classList.add('text-green-600');
        msgEl.classList.remove('text-red-600');

    } else if(winner=='O'){
        score -= 1;
        streak = 0;
        msgEl.innerText='😢 You Lose!';
        msgEl.classList.add('text-red-600');
        msgEl.classList.remove('text-green-600');
    }

    updateScoreUI();
    sendScoreToServer(winner); // Update the database for real
    setTimeout(resetBoard, 1000);
}

// ======= Display a draw =======
function showDraw(){
    const msgEl = document.getElementById('message');
    msgEl.innerText = '🤝 Draw!';
    msgEl.classList.remove('text-red-600','text-green-600');

    setTimeout(resetBoard, 1000);
}

// ======= Bot move =======
function botMove(){
    const emptyCells = [];
    for(let i=0;i<3;i++){
        for(let j=0;j<3;j++){
            if(board[i][j]=='') emptyCells.push([i,j]);
        }
    }
    if(emptyCells.length==0) return;

    const [i,j] = emptyCells[Math.floor(Math.random()*emptyCells.length)];
    board[i][j]='O';
    document.getElementById(`cell-${i}-${j}`).innerText='O';
}

// ======= Player move =======
function makeMove(i, j){
    if(board[i][j]!='') return;

    board[i][j]='X';
    document.getElementById(`cell-${i}-${j}`).innerText='X';

    let winner = checkWinner(board);
    if(winner){ showWinner(winner); return; }

    if(board.flat().every(cell => cell != '')){ showDraw(); return; }

    setTimeout(()=>{
        botMove();
        winner = checkWinner(board);
        if(winner){ showWinner(winner); return; }
        if(board.flat().every(cell => cell != '')){ showDraw(); }
    }, 1000 + Math.random()*1000);
}
