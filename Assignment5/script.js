
//global variables
var posList;
var marked;
var playing;

function loadGame(){
	posList = Array.from(Array(9).keys());
	marked = Array(9).fill(0);
	playing = true

	for (i=0; i<posList.length; i++){
		document.getElementById(posList[i]).innerText = ""
	}

	document.getElementById("gamestatus").innerText = ""
}

function playerMove(cell, clickedID) {
	if(playing){
		if(cell.innerText != ""){
			alert("This cell is not empty!");
		}
		else {

			cell.innerText = "X";
			marked[clickedID] = 1

			checkWin();

			if(playing)
				setTimeout(computerMove,500);
				setTimeout(checkWin,500);
		}
	}
}

function computerMove() {
	
	//computer prioritizes move based on the strategy described here: https://en.wikipedia.org/wiki/Tic-tac-toe#Strategy

	//case 1: there is a chance for the computer to win
	if (marked[0]===0 && ((marked[1]===2 && marked[2]===2) || (marked[3]===2 && marked[6]===2) || (marked[4]===2 && marked[8]===2))) {
		document.getElementById("0").innerText = "O";
		marked[0] = 2;
		return;
	}
	else if (marked[1]===0 && ((marked[0]===2 && marked[2]===2) || (marked[4]===2 && marked[7]===2))) {
		document.getElementById("1").innerText = "O";
		marked[1] = 2;
		return;
	}
	else if (marked[2]===0 && ((marked[1]===2 && marked[0]===2) || (marked[5]===2 && marked[8]===2) || (marked[4]===2 && marked[6]===2))) {
		document.getElementById("2").innerText = "O";
		marked[2] = 2;
		return;
	}
	else if (marked[3]===0 && ((marked[0]===2 && marked[6]===2) || (marked[4]===2 && marked[5]===2))) {
		document.getElementById("3").innerText = "O";
		marked[3] = 2;
		return;
	}
	else if (marked[4]===0 && ((marked[1]===2 && marked[7]===2) || (marked[5]===2 && marked[3]===2) || (marked[2]===2 && marked[6]===2) || (marked[0]===2 && marked[8]===2))) {
		document.getElementById("4").innerText = "O";
		marked[4] = 2;
		return;
	}
	else if (marked[5]===0 && ((marked[2]===2 && marked[8]===2) || (marked[4]===2 && marked[3]===2))) {
		document.getElementById("5").innerText = "O";
		marked[5] = 2;
		return;
	}
	else if (marked[6]===0 && ((marked[3]===2 && marked[0]===2) || (marked[7]===2 && marked[8]===2) || (marked[4]===2 && marked[2]===2))) {
		document.getElementById("6").innerText = "O";
		marked[6] = 2;
		return;
	}
	else if (marked[7]===0 && ((marked[6]===2 && marked[8]===2) || (marked[4]===2 && marked[1]===2))) {
		document.getElementById("7").innerText = "O";
		marked[7] = 2;
		return;
	}
	else if (marked[8]===0 && ((marked[2]===2 && marked[5]===2) || (marked[7]===2 && marked[6]===2) || (marked[4]===2 && marked[0]===2))) {
		document.getElementById("8").innerText = "O";
		marked[8] = 2;
		return;
	}

	//case 2: there is a chance for the computer to block a winning move from the player
	else if (marked[0]===0 && ((marked[1]===1 && marked[2]===1) || (marked[3]===1 && marked[6]===1) || (marked[4]===1 && marked[8]===1))) {
		document.getElementById("0").innerText = "O";
		marked[0] = 2;
		return;
	}
	else if (marked[1]===0 && ((marked[0]===1 && marked[2]===1) || (marked[4]===1 && marked[7]===1))) {
		document.getElementById("1").innerText = "O";
		marked[1] = 2;
		return;
	}
	else if (marked[2]===0 && ((marked[1]===1 && marked[0]===1) || (marked[5]===1 && marked[8]===1) || (marked[4]===1 && marked[6]===1))) {
		document.getElementById("2").innerText = "O";
		marked[2] = 2;
		return;
	}
	else if (marked[3]===0 && ((marked[0]===1 && marked[6]===1) || (marked[4]===1 && marked[5]===1))) {
		document.getElementById("3").innerText = "O";
		marked[3] = 2;
		return;
	}
	else if (marked[4]===0 && ((marked[1]===1 && marked[7]===1) || (marked[5]===1 && marked[3]===1) || (marked[2]===1 && marked[6]===1) || (marked[0]===1 && marked[8]===1))) {
		document.getElementById("4").innerText = "O";
		marked[4] = 2;
		return;
	}
	else if (marked[5]===0 && ((marked[2]===1 && marked[8]===1) || (marked[4]===1 && marked[3]===1))) {
		document.getElementById("5").innerText = "O";
		marked[5] = 2;
		return;
	}
	else if (marked[6]===0 && ((marked[3]===1 && marked[0]===1) || (marked[7]===1 && marked[8]===1) || (marked[4]===1 && marked[2]===1))) {
		document.getElementById("6").innerText = "O";
		marked[6] = 2;
		return;
	}
	else if (marked[7]===0 && ((marked[6]===1 && marked[8]===1) || (marked[4]===1 && marked[1]===1))) {
		document.getElementById("7").innerText = "O";
		marked[7] = 2;
		return;
	}
	else if (marked[8]===0 && ((marked[2]===1 && marked[5]===1) || (marked[7]===1 && marked[6]===1) || (marked[4]===1 && marked[0]===1))) {
		document.getElementById("8").innerText = "O";
		marked[8] = 2;
		return;
	}

	//case 3: the computer plays the center position
	else if (marked[4]===0){
		document.getElementById("4").innerText = "O";
		marked[4] = 2;
		return;
	}

	//case 4: the computer plays the opposite corner
	if (marked[0]===0 && marked[8]===1) {
		document.getElementById("0").innerText = "O";
		marked[0] = 2;
		return;
	}
	if (marked[2]===0 && marked[6]===1) {
		document.getElementById("2").innerText = "O";
		marked[2] = 2;
		return;
	}
	if (marked[6]===0 && marked[2]===1) {
		document.getElementById("6").innerText = "O";
		marked[6] = 2;
		return;
	}
	if (marked[8]===0 && marked[0]===1) {
		document.getElementById("8").innerText = "O";
		marked[8] = 2;
		return;
	}
	
	//case 5: empty corner
	if (marked[0]===0) {
		document.getElementById("0").innerText = "O";
		marked[0] = 2;
		return;
	}
	if (marked[2]===0) {
		document.getElementById("2").innerText = "O";
		marked[2] = 2;
		return;
	}
	if (marked[6]===0) {
		document.getElementById("6").innerText = "O";
		marked[6] = 2;
		return;
	}
	if (marked[8]===0) {
		document.getElementById("8").innerText = "O";
		marked[8] = 2;
		return;
	}

	//case 6: empty side
	if (marked[1]===0) {
		document.getElementById("1").innerText = "O";
		marked[1] = 2;
		return;
	}
	if (marked[3]===0) {
		document.getElementById("3").innerText = "O";
		marked[3] = 2;
		return;
	}
	if (marked[5]===0) {
		document.getElementById("5").innerText = "O";
		marked[5] = 2;
		return;
	}
	if (marked[7]===0) {
		document.getElementById("7").innerText = "O";
		marked[7] = 2;
		return;
	}

	//random move
	else {
		do{
		var pos = posList[Math.floor(Math.random() * posList.length)];
	} while(marked[pos] != 0);

	document.getElementById(pos).innerText = "O";

	marked[pos] = 2
	}
}


function checkWin() {

	//check if player has won
	if (marked[0]===marked[1] && marked[1]===marked[2] && marked[0]===1){
		document.getElementById("gamestatus").innerText = "Congratulations! You won!";
		playing = false;
		return;
	}
	else if (marked[3]===marked[4] && marked[4]===marked[5] && marked[3]===1){
		document.getElementById("gamestatus").innerText = "Congratulations! You won!";
		playing = false;
		return;
	}
	else if (marked[6]===marked[7] && marked[7]===marked[8] && marked[6]===1){
		document.getElementById("gamestatus").innerText = "Congratulations! You won!";
		playing = false;
		return;
	}
	else if (marked[0]===marked[3] && marked[3]===marked[6] && marked[0]===1){
		document.getElementById("gamestatus").innerText = "Congratulations! You won!";
		playing = false;
		return;
	}
	else if (marked[1]===marked[4] && marked[4]===marked[7] && marked[1]===1){
		document.getElementById("gamestatus").innerText = "Congratulations! You won!";
		playing = false;
		return;
	}
	else if (marked[2]===marked[5] && marked[5]===marked[8] && marked[2]===1){
		document.getElementById("gamestatus").innerText = "Congratulations! You won!";
		playing = false;
		return;
	}
	else if (marked[0]===marked[4] && marked[4]===marked[8] && marked[0]===1){
		document.getElementById("gamestatus").innerText = "Congratulations! You won!";
		playing = false;
		return;
	}
	else if (marked[2]===marked[4] && marked[4]===marked[6] && marked[2]===1){
		document.getElementById("gamestatus").innerText = "Congratulations! You won!";
		playing = false;
		return;
	}

	//check if computer has won
	else if (marked[0]===marked[1] && marked[1]===marked[2] && marked[0]===2){
		document.getElementById("gamestatus").innerText = "You lost! Better luck next time!";
		playing = false;
		return;
	}
	else if (marked[3]===marked[4] && marked[4]===marked[5] && marked[3]===2){
		document.getElementById("gamestatus").innerText = "You lost! Better luck next time!";
		playing = false;
		return;
	}
	else if (marked[6]===marked[7] && marked[7]===marked[8] && marked[6]===2){
		document.getElementById("gamestatus").innerText = "You lost! Better luck next time!";
		playing = false;
		return;
	}
	else if (marked[0]===marked[3] && marked[3]===marked[6] && marked[0]===2){
		document.getElementById("gamestatus").innerText = "You lost! Better luck next time!";
		playing = false;
		return;
	}
	else if (marked[1]===marked[4] && marked[4]===marked[7] && marked[1]===2){
		document.getElementById("gamestatus").innerText = "You lost! Better luck next time!";
		playing = false;
		return;
	}
	else if (marked[2]===marked[5] && marked[5]===marked[8] && marked[2]===2){
		document.getElementById("gamestatus").innerText = "You lost! Better luck next time!";
		playing = false;
		return;
	}
	else if (marked[0]===marked[4] && marked[4]===marked[8] && marked[0]===2){
		document.getElementById("gamestatus").innerText = "You lost! Better luck next time!";
		playing = false;
		return;
	}
	else if (marked[2]===marked[4] && marked[4]===marked[6] && marked[2]===2){
		document.getElementById("gamestatus").innerText = "You lost! Better luck next time!";
		playing = false;
		return;
	}

	//check if tie
	playing = false;
	for (i=0; i<marked.length; i++)
		if (marked[i]===0)
			playing = true;
	if (playing === false)
		document.getElementById("gamestatus").innerText = "It's a tie!"

}
