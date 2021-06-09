window.onload = () => {
  const datalist = document.getElementById("data");
  
  for (item in databaseList) {
    const newOption = document.createElement('option');
    newOption.value = item;
    datalist.appendChild(newOption);
  }
}