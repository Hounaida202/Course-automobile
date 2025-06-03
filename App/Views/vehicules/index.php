   <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
   <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Racing World - Courses Automobiles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-400">Racing World</div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-blue-400">Accueil</a>
                <a href="#courses" class="hover:text-blue-400">Courses</a>
                <a href="#" class="hover:text-blue-400">Calendrier</a>
                <a href="#" class="hover:text-blue-400">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-600 py-20">
        <div class="max-w-6xl mx-auto text-center px-4">
            <h1 class="text-5xl font-bold mb-4">Courses Automobiles</h1>
            <p class="text-xl mb-8">Découvrez les courses les plus excitantes</p>
            <a href="#courses" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                Voir les Courses
            </a>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="py-16 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Nos Courses</h2>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Course 1 -->
                 <?php foreach($courses as $course):?>
                <a href="/vehicules/show/<?= $course->getId() ?>" class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition-colors">
                    <h3 class="text-xl font-bold text-blue-400 mb-3"><?=htmlspecialchars($course->getNom())?></h3>
                    <!-- <p class="text-gray-300 mb-4">Course de vitesse ultime sur circuit fermé</p> -->
                    <div class="bg-gray-700 rounded p-3">
                        <span class="text-sm text-gray-400">Véhicule autorisé:</span>
                        <p class="font-semibold"><?=htmlspecialchars($course->getType())?></p>
                    </div>
                 </a>
                <?php endforeach ?>

                
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto text-center px-4">
            <p class="text-gray-400">&copy; 2025 Racing World. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>