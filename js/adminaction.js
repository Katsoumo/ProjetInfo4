      function toggleVIP(button) {
            const row = button.closest("tr");
            const statusCell = row.querySelector("td:nth-child(3)");
            if (statusCell.innerText === "VIP") {
                statusCell.innerText = "Standard";
                button.classList.remove("active");
            } else {
                statusCell.innerText = "VIP";
                button.classList.add("active");
            }
        }
        function toggleBan(button) {
            const row = button.closest("tr");
            const statusCell = row.querySelector("td:nth-child(3)");
            if (statusCell.innerText === "Banni") {
                statusCell.innerText = "Standard";
                button.classList.remove("active");
            } else {
                statusCell.innerText = "Banni";
                button.classList.add("active");
            }
        }