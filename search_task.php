<!-- HTML form -->
<style>
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #searchBox {
        width: 80%;
        padding: 8px;
        margin-bottom: 16px;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    #productList {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Example styling for product items */
    .product {
        width: 200px;
        margin: 8px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        text-align: center;
        font-size: 14px;
    }
</style>
<form>
    <p>Search form</p>
    <input type="text" id="searchBox" onkeyup="getProducts()">
    <div id="productList"></div>
</form>

<!-- JavaScript code -->
<script>
    function getProducts() {
        var input = document.getElementById("searchBox").value;
        if (input.length == 0) {
            document.getElementById("productList").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("productList").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "get_tasks_dropdown.php?q=" + input, true);
            xmlhttp.send();
        }
    }
</script>