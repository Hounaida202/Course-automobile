<?php
 session_start();
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formule 1 - Détails Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-400">Racing World</div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-blue-400">Accueil</a>
                <a href="#" class="hover:text-blue-400">Courses</a>
                <a href="#" class="hover:text-blue-400">Calendrier</a>
                <a href="#" class="hover:text-blue-400">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Race Info Section -->
    <section class="py-12">
          <?php if (isset($_SESSION['success'])): ?>
<div class="bg-green-500 ml-24 mr-24  text-white p-4 mb-10 mt-10 rounded">
    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
</div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
<div class="bg-red-500 ml-24 mr-24 text-white p-4 mb-10 mt-10 rounded">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
</div>
<?php endif; ?>
        <div class="max-w-6xl mx-auto px-4">
            <!-- Course Header -->
            <div class="bg-blue-600 rounded-lg p-8 mb-8">
                <h1 class="text-4xl font-bold mb-4">Formule 1</h1>
                <p class="text-xl mb-4">Course de vitesse ultime sur circuit fermé</p>
                <div class="bg-blue-700 rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">Type de véhicule autorisé</h3>
                    <p class="text-2xl font-bold">Monoplace F1</p>
                </div>
            </div>

            <!-- Participating Vehicles -->
            <!-- Participating Vehicles -->
<div>
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold">Véhicules Participants</h2>
        <button onclick="openModal()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
            Ajouter un Véhicule
        </button>
    </div>

    <!-- Flex au lieu de grid -->
  
    <div class="flex flex-wrap gap-6 justify-center">
        <!-- Vehicle 1 -->
                          <?php foreach($participants as $participant):?>

        <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-700 transition-colors w-full md:w-[45%] lg:w-[30%]">
            <h3 class="text-xl font-bold text-red-400 mb-3"><?=htmlspecialchars($participant->getNom())?></h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-400">Type:</span>
                    <span class="font-semibold">Monoplace F1</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Puissance:</span>
                    <span class="font-semibold text-yellow-400">1000 HP</span>
                </div>
            </div>
        </div>
                       <?php endforeach ?>

   
    </div>
</div>


            <!-- Back Button -->
            <div class="text-center mt-12">
                <a href="/fruits" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                    Retour aux Courses
                </a>
            </div>
        </div>
    </section>
 <!-- Modal -->
    <div id="vehicleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-8 max-w-md w-full mx-4">
            <h3 class="text-2xl font-bold mb-6">Ajouter un Véhicule</h3>
            <form id="vehicleForm" method="POST" action="/fruits/store">
                 <input type="hidden" name="course_id" value="<?= $course->getId() ?>">
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Nom du véhicule</label>
                    <input type="text" name="nom" id="vehicleName" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Type</label>
                    <select id="vehicleType" name="type" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                        <option value="">Sélectionner un type</option>
                        <option value="F1">F1</option>
                        <option value="Rallye">Rallye</option>
                        <option value="Kart">Kart</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-300 text-sm font-bold mb-2">Puissance (HP)</label>
                    <input type="number" name="puissance" id="vehiclePower" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
  
   
    <!-- Footer -->
    <footer class="bg-gray-800 py-8 mt-12">
        <div class="max-w-6xl mx-auto text-center px-4">
            <p class="text-gray-400">&copy; 2025 Racing World. Tous droits réservés.</p>
        </div>
    </footer>
   <script>
function openModal() {
    document.getElementById('vehicleModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('vehicleModal').classList.add('hidden');
}

// Optionnel : Fermer le modal si on clique à l’extérieur du contenu


    

</script>

</body>
</html>