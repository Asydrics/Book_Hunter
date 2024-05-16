<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../app/views/templates/partials/_head.php'; ?>
</head>

<body class="bg-gray-900 text-white font-sans leading-normal tracking-normal">
    <!-- Header -->
    <?php include_once '../app/views/templates/partials/_header.php'; ?>
    <!-- Main -->
    <div class="container mx-auto flex flex-wrap pt-4 pb-12 text-white">
        <!-- Aside -->
        <aside class="w-full md:w-1/4 p-3">
            <?php include_once '../app/views/templates/partials/_aside.php'; ?>
        </aside>
        <!-- Main content -->
        <!-- Zone dynamique $content -->
        <main>
            <?php include_once '../app/views/templates/partials/_main.php'; ?>
        </main>
        <!-- Footer -->
        <footer class="bg-gray-700 text-gray-400 shadow">
            <?php include_once '../app/views/templates/partials/_footer.php'; ?>
        </footer>
    </div>
</body>

</html>