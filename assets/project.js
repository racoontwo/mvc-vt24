// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/project.css';
import { visualizeData } from './js/csvTable';

// Initialize the CSV table visualization
// document.addEventListener('DOMContentLoaded', () => {
//     visualizeCSVTable('csvFileInput', 'dataTable');
// });

const jsonData = [
    { "name": "A", "value": 30 },
    { "name": "B", "value": 80 },
    { "name": "C", "value": 45 },
    { "name": "D", "value": 60 },
    { "name": "E", "value": 20 },
    { "name": "F", "value": 90 },
    { "name": "G", "value": 55 }
];

visualizeData(jsonData);

console.log("testing csv")
console.log('This log comes from assets/project.js - welcome to AssetMapper! 🎉');
