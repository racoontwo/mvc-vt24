import './styles/project.css';
import { visualizeData } from './js/visualize';

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

        return transformedData;
    })
    .catch(error => {
        console.error('Error fetching data:', error);
        throw error;
    });
}

// Event listener for DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    fetchData()
        .then(transformedData => {
            const type = "Skyddszoner";
            visualizeData(transformedData, type);
        })
        .catch(error => {
            console.error('Error in processing data:', error);
        });
});
