import * as d3 from 'd3';

export function visualizeData(data) {
    // Set up SVG canvas dimensions
    const width = 600;
    const height = 400;
    const margin = { top: 20, right: 30, bottom: 40, left: 40 };

    // Create an SVG container in the specific div
    const svg = d3.select('#graph').append('svg')
        .attr('width', width)
        .attr('height', height);

    // Define scales for x and y axes
    const xScale = d3.scaleBand()
        .domain(data.map(d => d.year))
        .range([margin.left, width - margin.right])
        .padding(0.1);

    const yScale = d3.scaleLinear()
        .domain([0, d3.max(data, d => +d.value)])
        .nice()
        .range([height - margin.bottom, margin.top]);

    // Define a color scale
    const colorScale = d3.scaleOrdinal(d3.schemeCategory10);

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
        .attr('x', d => xScale(d.year))
        .attr('y', d => yScale(+d.value))
        .attr('width', xScale.bandwidth())
        .attr('height', d => yScale(0) - yScale(+d.value))
        .attr('fill', d => colorScale(d.name));
}

// Example usage with JSON data
const jsonData = [
    { "year": "1999", "value": 30 },
    { "year": "2000", "value": 80 },
    { "year": "2001", "value": 45 },
    { "year": "2002", "value": 60 },
    { "year": "2003", "value": 20 },
    { "year": "2004", "value": 90 },
    { "year": "2005", "value": 55 }
];
