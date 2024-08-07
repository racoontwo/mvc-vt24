import './styles/project.css';
import { visualizeData } from './js/visualize';

document.addEventListener('DOMContentLoaded', function() {
    fetch('/project/show_forestry')
        .then(response => response.json())
        .then(data => {
            console.log('Forest data:', data);

            const transformedData = data.map(item => ({
                year: item.year,
                value: parseInt(item.skyddszoner)
            }));

            visualizeData(transformedData);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});
