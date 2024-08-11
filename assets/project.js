import './styles/project.css';
import { visualizeData } from './js/visualize';
import { chartData } from './js/chart';
import { fetchData, getOneData } from './js/fetchData';


function getVisibleDivIds() {
    const visibleDivs = Array.from(document.querySelectorAll('div')).filter(div => {
        const style = window.getComputedStyle(div);
        return style.display !== 'none' && style.visibility !== 'hidden' && style.opacity !== '0';
    });

    return visibleDivs.map(div => div.id).filter(id => id !== '');
}

// Event listener for DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    fetchData('/project/show_forestry')
        .then(data => {
            chartData(data);
        })
        .catch(error => {
            console.error('Error in processing data:', error);
        });
    fetchData('/project/show_redlisted')
    .then(data => {
        console.log("This is ", data);
        const type = "Bin";
        const transformedData = getOneData(data, type.toLowerCase());
        console.log("whats this,", transformedData);
        visualizeData(transformedData, type);
    })
    .catch(error => {
        console.error('Error in processing data:', error);
    });
});
