#!/usr/bin/env node
const fs = require('fs');
const readline = require('readline');

const file = process.argv[2];

const rl = readline.createInterface({
  input: fs.createReadStream(file),
  output: process.stdout,
  terminal: false
});

let lines = [];
rl.on('line', (line) => {
  lines.push(line);
});

rl.on('close', () => {
  const c = lines.splice(0, 1);
  for (let i = 1; i <= c; i++) {
    const n = lines.splice(0, 1);
    const matches = lines.splice(0, n);
    const scores = [];
    for (let j = 0, len = matches.length; j < len; j++) {
      const match = matches[j].split(' ');
      const p1 = match[0];
      const p2 = match[1];
      if (!scores[p1]) {
        scores[p1] = [0, 0, p1];
      }
      if (!scores[p2]) {
        scores[p2] = [0, 0, p2];
      }
      if (match[2] == 1) {
        scores[p1][0]++;
        scores[p2][1]++;
      } else {
        scores[p1][1]++;
        scores[p2][0]++;
      }
    }
    scores.sort((a, b) => (a[1] - b[1]));
    console.log(`Case #${i}: ${scores[0][2]}`);
  }
});
