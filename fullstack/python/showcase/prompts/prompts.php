 <?php
   // https://www.hotbot.com/chat

   // Database connection
   $db = new PDO('sqlite:prompts.db');

   // Set number of items per page
   $itemsPerPage = 10;

   // Get the current page number from URL, default to 1
   $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
   $offset = ($currentPage - 1) * $itemsPerPage;

   // Fetch total items for pagination
   $totalItemsQuery = $db->query("SELECT COUNT(*) FROM prompts");
   $totalItems = $totalItemsQuery->fetchColumn();
   $totalPages = ceil($totalItems / $itemsPerPage);

   // Fetch items for current page
   $stmt = $db->prepare("SELECT * FROM prompts LIMIT :limit OFFSET :offset");
   $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
   $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
   $stmt->execute();
   $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
   ?>

   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Pagination Example</title>
   </head>
   <body>
       <h1>Items</h1>
       <ul>
           <?php foreach ($items as $item): ?>

               <div style="display: table-row flex; border: 1px solid black;">
                    <div style="display: table-cell;width:5%">
                        <?php echo htmlspecialchars($item['id']); ?>
                    </div>
                     <div style="display: table-cell;width:20%">
                        <?php echo htmlspecialchars($item['name']); ?>
                    </div>
                    <div style="display: table-cell;width:45%">
                        <?php echo htmlspecialchars($item['prompt']); ?>
                    </div>
                     <div style="display: table-cell;width:5%">
                        <?php echo htmlspecialchars($item['type']); ?>
                    </div>
                     <div style="display: table-cell;width:5%">
                        <?php echo htmlspecialchars($item['score']); ?>
                    </div>
                    <div style="display: table-cell;width:25%">
                        <?php echo htmlspecialchars($item['created_date']); ?>
                    </div>
               </div>

           <?php endforeach; ?>
       </ul>

       <div class="pagination">
           <?php if ($currentPage > 1): ?>
               <a href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
           <?php endif; ?>

           <span>Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>

           <?php if ($currentPage < $totalPages): ?>
               <a href="?page=<?php echo $currentPage + 1; ?>">Next</a>
           <?php endif; ?>
       </div>
   </body>
   </html>
