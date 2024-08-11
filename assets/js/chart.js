import * as d3 from 'd3';

export function chartData(data) {
    const width = 600
    const height = 300
    const margins = { top: 20, right: 20, bottom: 30, left: 20 }; // Initial margin setup
    const svgWidth = width + margins.left + margins.right;
    const svgHeight = height + margins.top + margins.bottom;

    const svg = d3.select(`#all`).append('svg')
        .attr('width', svgWidth)
        .attr('height', svgHeight)
        .attr("viewBox", `0 0 ${svgWidth} ${svgHeight}`);

    const g = svg.append("g")
        .attr("transform", `translate(${margins.left},${margins.top})`);

    const x0 = d3.scaleBand()
        .domain(data.map(d => d.year))
        .range([0, width])
        .padding(0.2);

    const x1 = d3.scaleBand()
        .domain(["hansynskravandeBiotoper", "skyddszoner", "upplevelsevarden", "kulturmiljoer", "transportOverVattendrag"])
        .range([0, x0.bandwidth()])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(data, d => 
            Math.max(
                d.hansynskravandeBiotoper, 
                d.skyddszoner, 
                d.upplevelsevarden,
                d.kulturmiljoer,
                d.transportOverVattendrag
            )
        )])
        .nice()
        .range([height, 0]);

    const color = d3.scaleOrdinal()
        .domain(["hansynskravandeBiotoper", "skyddszoner", "upplevelsevarden", "kulturmiljoer", "transportOverVattendrag"])
        .range(['#4BC0C0', '#36A2EB', '#FF6384', '#FF9F40', '#FFCE56']);

    const labels = {
        "hansynskravandeBiotoper": "Hänsynskrävande Biotoper",
        "skyddszoner": "Skyddszoner",
        "upplevelsevarden": "Upplevelsevärden",
        "kulturmiljoer": "Kulturmiljöer",
        "transportOverVattendrag": "Transport Över Vattendrag"
    };

    
    const bars = g.selectAll(".year-group")
        .data(data)
        .enter().append("g")
        .attr("class", "year-group")
        .attr("transform", d => `translate(${x0(d.year)},0)`)
        .selectAll("rect")
        .data(d => [
            {key: "hansynskravandeBiotoper", value: d.hansynskravandeBiotoper},
            {key: "skyddszoner", value: d.skyddszoner},
            {key: "upplevelsevarden", value: d.upplevelsevarden},
            {key: "kulturmiljoer", value: d.kulturmiljoer},
            {key: "transportOverVattendrag", value: d.transportOverVattendrag}
        ])
        .enter().append("rect")
        .attr("class", d => `bar ${d.key}`)
        .attr("x", d => x1(d.key))
        .attr("y", d => y(d.value))
        .attr("width", x1.bandwidth())
        .attr("height", d => height - y(d.value))
        .attr("fill", d => color(d.key));

    
    g.append("g")
        .attr("class", "x-axis")
        .attr("transform", `translate(0,${height})`)
        .call(d3.axisBottom(x0).tickSize(0).tickPadding(6));

    
    g.append("g")
        .attr("class", "y-axis")
        .call(d3.axisLeft(y).ticks(10));

    
    const legendWidth = 150;
    const legendHeight = 20;
    const legendSpacing = 10;

    const legend = g.append("g")
        .attr("transform", `translate(15, 0)`);

    legend.selectAll(".legend-item")
        .data(color.domain())
        .enter().append("g")
        .attr("class", "legend-item")
        .attr("transform", (d, i) => `translate(0,${i * (legendHeight + legendSpacing)})`) // Arrange items vertically
        .each(function(d) {
            const item = d3.select(this);
            item.append("rect")
                .attr("x", 0)
                .attr("width", legendHeight)
                .attr("height", legendHeight)
                .attr("fill", color(d))
                .style("cursor", "pointer");

            item.append("text")
                .attr("x", legendHeight + 5)
                .attr("y", legendHeight / 2)
                .attr("dy", "0.2em")
                .text(labels[d])
                .style("font-size", "0.5em")
                .style("alignment-baseline", "middle");

            item.on("click", function() {
                const isVisible = svg.selectAll(`.${d}`).style("display") !== "none";
                svg.selectAll(`.${d}`).style("display", isVisible ? "none" : "block");
                d3.select(this).select("rect").style("stroke", isVisible ? "none" : "black"); // Highlight selected legend
            });
        });

    return svg.node();
}
