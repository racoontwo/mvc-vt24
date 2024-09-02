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

    // Select the div element using querySelector
    const resultDiv = window.redlistedData;

    // Retrieve the value of the data-res attribute
    // const resData = resultDiv.getAttribute('data-res');

    // Optionally, if the data is in JSON format, you can parse it
    // const resDataParsed = JSON.parse(resData);

    console.log(resultDiv);

    // fetchData(`${baseUrl}/project/show_forestry`)
    fetchData(`/project/show_forestry`)
        .then(data => {
            chartData(data);
        })
        .catch(error => {
            console.error('Error in processing data:', error);
        });
    // fetchData(`${baseUrl}/project/show_redlisted`)
    fetchData(`/project/show_redlisted`)
    .then(data => {
        const type = "Bin";
        const transformedData = getOneData(data, type.toLowerCase());
        visualizeData(transformedData, type);
        visualizeData(transformedData, "mossor");
    })
    .catch(error => {
        console.error('Error in processing data:', error);
    });

});
