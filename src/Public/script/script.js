let search = document.querySelector("#searching");

console.log(search);

search.addEventListener("input", (e) => {
  let Name = search.value;

  // console.log(search_value);
});

async function getData(Name) {
  // let url = '/allaData';

  try {
    let Response = await fetch("/allaData.php?query=" + Name);

    if (!Response.ok) {
      throw new Error(`Response status : ${response.status}`);
    }
    const result = await Response.json();
    
  } catch (error) {
    console.error(error.message);
  }
  //   then((Response) => Response.json());
}
