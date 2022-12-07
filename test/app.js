function search(param1, param2) {
	
	const options = {
		method: 'GET',
		headers: {
			'X-RapidAPI-Key': 'a686ab8425msh2443fc485de7c08p17cbe9jsnd64a4599be94',
			'X-RapidAPI-Host': 'shazam.p.rapidapi.com'
		}
	};
	const url = `https://shazam.p.rapidapi.com/search?term=${param1}%20${param2}&locale=en-US&offset=0&limit=5`
	fetch(url, options)
	.then(response => response.json())
	.then((data) => {
		const result = data.tracks.hits;
		result.forEach(e => {
			const title = e.track["title"]
			const artist = e.track["subtitle"]
			document.querySelector("#search").innerHTML += `<option>${title} par ${artist}</option>`
		});
	})
	.catch(err => console.error(err));
}
// let p1 = 'enemy'
// let p2 = 'imagine dragons'
// search(p1,p2)