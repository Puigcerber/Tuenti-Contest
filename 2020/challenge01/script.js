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

const rpsMap = {
  'R': {
    'R': '-',
    'P': 'P',
    'S': 'R'
  },
  'P': {
    'P': '-',
    'S': 'S',
    'R': 'P'
  },
  'S': {
    'S': '-',
    'R': 'R',
    'P': 'S'
  },
};

rl.on('line', (line, i = lineCount()) => {
  if (i === 0) return;
  console.log(`Case #${i}: ${rpsMap[line[0]][line[2]]}`);
});
