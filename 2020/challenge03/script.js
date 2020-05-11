#!/usr/bin/env node
const fs = require('fs');
const readline = require('readline');

const file = process.argv[2];

const rl = readline.createInterface({
  input: fs.createReadStream(file),
  output: process.stdout,
  terminal: false
});
const lineCount = ((i = 0) => () => i++)();

const galdos = fs.readFileSync(`${process.cwd()}/pg17013.txt`);
const words = galdos.toString('utf8').match(/[a-záéíñóúü]+/gi);
// Count word appearances
let ranking = {};
for (const word of words) {
  if (word.length >= 3) {
    const w = word.toLowerCase();
    if (ranking[w]) {
      ranking[w]++;
    } else {
      ranking[w] = 1;
    }
  }
}
// Sort by highest frequency and unicode when is the same
let sortable = [];
for (const word in ranking) {
    sortable.push([word, ranking[word]]);
}
sortable.sort(function(a, b) {
  if (a[1] != b[1]) {
    return b[1] - a[1];
  } else {
    return (a[0] < b[0] ? -1 : 1);
  }
});
// Usable object with ranking
ranking = {};
for (const [i, s] of sortable.entries()) {
  const word = s[0];
  const instances = s[1];
  ranking[word] = {
    r: i + 1, // ranking
    i: instances // instances
  }
}

rl.on('line', (line, i = lineCount()) => {
  if (i === 0) return;
  if (isNaN(line)) {
    const word = ranking[line];
    console.log(`Case #${i}: ${word.i} #${word.r}`);
  } else {
    const rank = sortable[line - 1];
    console.log(`Case #${i}: ${rank[0]} ${rank[1]}`);
  }
});
