import './styles/project.css';
import { visualizeData } from './js/visualize';
import { chartData } from './js/chart';

// Function to fetch and transform data
function fetchData() {
    // const apiUrl = 'https://api.scb.se/OV0104/v1/doris/sv/ssd/START/MI/MI1303/MI1303B/ExplVatmark';
    const apiUrl = '/project/show_forestry';
    
    return fetch(apiUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Forest data:', data);

        // Transform the data as needed
        const transformedData = data.map(item => ({
            year: item.year,
            value: parseInt(item.skyddszoner)
        }));

        return data;
    })
    .catch(error => {
        console.error('Error fetching data:', error);
        throw error;
    });
}

function transformData(rawData, name) {
    const transformedData = rawData.map(item => ({
        year: item.year,
        value: parseInt(item[name]) // Use bracket notation to access the property dynamically
    }));
    return transformedData;
}


function getVisibleDivIds() {
    const visibleDivs = Array.from(document.querySelectorAll('div')).filter(div => {
        const style = window.getComputedStyle(div);
        return style.display !== 'none' && style.visibility !== 'hidden' && style.opacity !== '0';
    });

    return visibleDivs.map(div => div.id).filter(id => id !== '');
}

// Event listener for DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    fetchData()
        .then(data => {
            const type = "Skyddszoner";
            // visualizeData(transformedData, type);
            console.log(data);
            chartData(data, 600, 400);
        })
        .catch(error => {
            console.error('Error in processing data:', error);
        });
});
