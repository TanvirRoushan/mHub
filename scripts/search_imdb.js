var imdb_req_url = 'http://www.imdbapi.com/';
var title, year, rating, genre, runtime, poster, id;
var imdb = 'http://www.imdb.com/title/';
var id_pattern = new RegExp("tt\\d+");
function search_imdb(movieName) {
	//alert(movieName);
	document.getElementById('toSearchImdb').href = "http://www.imdb.com/find?q="+movieName;
	if(id_pattern.test(movieName))
	{
		my_url = imdb_req_url+ "?i=" + movieName;
	}
	else{
		my_url = imdb_req_url+ "?t=" + movieName;
	}
	
	$.getJSON(my_url, function(json_data) {
		//  alert(JSON.stringify(json_data));
		title = json_data.Title;
		year = json_data.Year;
		rating = json_data.imdbRating;
		genre = json_data.Genre;
		runtime = json_data.Runtime;
		poster = json_data.Poster;
		id = json_data.imdbID;
		document.getElementById("pp_title").innerHTML = title;
		document.getElementById("pp_year").innerHTML = year;
		document.getElementById("pp_rating").innerHTML = rating;
		document.getElementById("pp_genre").innerHTML = genre;
		document.getElementById("pp_runtime").innerHTML = runtime;
		document.getElementById("pp_poster").src = poster;
		document.getElementById("pp_imdbID").src = id;
		//alert(json_data.Title+"\n"+json_data.Year);
	});
	document.getElementById("pp_div").style.display = "block";
}

function yes() {
	document.getElementById("pp_div").style.display = "none";
	document.getElementById("id_title").value = title;
	document.getElementById("id_year").value = year;
	document.getElementById("id_imdb_link").value = imdb + id;
}

function no() {
	document.getElementById("pp_div").style.display = "none";
}
