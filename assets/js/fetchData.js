export function fetchData(apiUrl) {
    // const apiUrl = 'https://api.scb.se/OV0104/v1/doris/sv/ssd/START/MI/MI1303/MI1303B/ExplVatmark';
    // const apiUrl = '/project/show_forestry';
    
    return fetch(apiUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('fetchedData', data);

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

export function getOneData(rawData, name) {
    const transformedData = rawData.map(item => ({
        year: item.year,
        value: item[name]
    }));
    console.log(transformedData);
    return transformedData;
}