import './styles/project.css';
import { visualizeData } from './js/visualize';
import { chartData } from './js/chart';
import { fetchData, getOneData } from './js/fetchData';


const baseUrl = `${window.location.origin}`;
console.log("hello", baseUrl);
// Event listener for DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {


    fetchData(`${baseUrl}/project/show_forestry`)
    // fetchData(`/project/show_forestry`)
        .then(data => {
            chartData(data);
        })
        .catch(error => {
            console.error('Error in processing data:', error);
        });
    fetchData(`${baseUrl}/project/show_redlisted`)
    // fetchData(`/project/show_redlisted`)
    .then(data => {
        const type = "Bin";
        const transformedData = getOneData(data, type.toLowerCase());
        // visualizeData(transformedData, type);
        // visualizeData(transformedData, "mossor");
    })
    .catch(error => {
        console.error('Error in processing data:', error);
    });

});
