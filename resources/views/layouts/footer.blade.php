
    </div>
 <script>
        const searchInput = document.getElementById('search');
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();
            document.querySelectorAll('.product-card').forEach(card => {
                card.style.display = card.dataset.name.includes(query) ? '' : 'none';
            });
        });
    </script>

</body>
</html>
