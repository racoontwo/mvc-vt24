// Import necessary libraries
import * as d3 from 'd3';

// Function to visualize data
export function visualizeData(data) {
    // Log the data to console (for debugging purposes)
    console.log(data);

    // Set up SVG canvas dimensions
    const width = 600;
    const height = 400;
    const margin = { top: 20, right: 30, bottom: 40, left: 40 };

    // Create an SVG container
    const svg = d3.select('#graph').append('svg')
        .attr('width', width)
        .attr('height', height);

    // Define scales for x and y axes
    const xScale = d3.scaleBand()
        .domain(data.map(d => d.name))
        .range([margin.left, width - margin.right])
        .padding(0.1);

    const yScale = d3.scaleLinear()
        .domain([0, d3.max(data, d => +d.value)])
        .nice()
        .range([height - margin.bottom, margin.top]);

    // Add x-axis to SVG
    svg.append('g')
        .attr('transform', `translate(0, ${height - margin.bottom})`)
        .call(d3.axisBottom(xScale));

    // Add y-axis to SVG
    svg.append('g')
        .attr('transform', `translate(${margin.left}, 0)`)
        .call(d3.axisLeft(yScale));

    // Create bars for the bar chart
    svg.selectAll('.bar')
        .data(data)
        .enter().append('rect')
        .attr('class', 'bar')
        .attr('x', d => xScale(d.name))
        .attr('y', d => yScale(+d.value))
        .attr('width', xScale.bandwidth())
        .attr('height', d => yScale(0) - yScale(+d.value))
        .attr('fill', 'steelblue');
}

// Example usage with JSON data
const jsonData = [
    { "name": "A", "value": 30 },
    { "name": "B", "value": 80 },
    { "name": "C", "value": 45 },
    { "name": "D", "value": 60 },
    { "name": "E", "value": 20 },
    { "name": "F", "value": 90 },
    { "name": "G", "value": 55 }
];

// Call the function to visualize the data
// visualizeData(jsonData);
