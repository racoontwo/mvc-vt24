import * as d3 from 'd3';

export function visualizeData(data, name) {
    // Set up SVG canvas dimensions
    const width = 300;
    const height = 200;
    const margin = { top: 60, right: 30, bottom: 40, left: 40 };
    const lowercaseName = name.toLowerCase();

    // Create an SVG container in the specific div
    const svg = d3.select(`#${lowercaseName}`).append('svg')
        .attr('width', width)
        .attr('height', height);

    svg.append('text')
    .attr('x', (width / 2))             
    .attr('y', (margin.top / 2))
    .attr('text-anchor', 'middle')
    .attr('class', 'offsetLabel')
    .style('font-size', '1.5em') 
    .text(name);

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
