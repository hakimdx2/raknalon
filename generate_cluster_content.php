<?php

require __DIR__ . '/vendor/autoload.php';

use App\Services\ProfessionService;

// Load environment variables if needed
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Initialize Services
$professionService = new ProfessionService();

// Define Key Structures (as Strings for the Prompt)
$structure_education = file_get_contents('/Users/harrar/.gemini/antigravity/brain/da5a14e1-2632-45e6-8386-2398f3aa1cc7/structure_article_ecole.md');
$structure_work = file_get_contents('/Users/harrar/.gemini/antigravity/brain/da5a14e1-2632-45e6-8386-2398f3aa1cc7/structure_article_boulot.md');

// Helper Function to Call Gemini/OpenAI (Simulated for now, replace with actual API call)
function generateAIContent($systemPrompt, $userPrompt, $model = 'gemini-pro')
{
    // In a real scenario, this would call the API.
    // For this script, we will output the PROMPT that needs to be sent.
    echo "\n\n--- AI PROMPT START ---\n";
    echo "SYSTEM: $systemPrompt\n";
    echo "USER: $userPrompt\n";
    echo "--- AI PROMPT END ---\n\n";

    // rudimentary mock response for testing flow
    return "<!-- MOCK CONTENT GENERATED FOR TESTING -->\n\n# Generated Title\n\nLorem ipsum content based on structure...";
}

// Main Logic
$slug = $argv[1] ?? null;

if (!$slug) {
    die("Usage: php generate_cluster_content.php [profession_slug]\nExample: php generate_cluster_content.php sjukskoterska\n");
}

echo "🔮 Starting Content Cluster Generation for: $slug\n";

// 1. Fetch Profession Data
$profession = $professionService->getBySlug($slug);

if (!$profession) {
    die("❌ Profession not found: $slug\n");
}

echo "✅ Profession Data Loaded: " . $profession['title'] . "\n";

// 2. Prepare Context for AI
$context = json_encode([
    'title' => $profession['title'],
    'description' => $profession['description'],
    'salary_median' => $profession['median_salary'] ?? 'N/A',
    'salary_avg' => $profession['avg_salary'] ?? 'N/A',
    'education_level' => $profession['education_level'] ?? 'N/A',
    // Add checks for other fields to avoid undefined index notices
    'top_employers' => $profession['employers'] ?? [],
    'pros' => $profession['pros'] ?? [],
    'cons' => $profession['cons'] ?? []
], JSON_PRETTY_PRINT);


// 3. Generate 'School' Article
echo "\n🏫 Generating 'School' Article...\n";
$systemPromptSchool = "Tu es un conseiller d'orientation expert en Suède. Ton ton est encourageant, précis et structuré.";
$userPromptSchool = "
CONTEXTE MÉTIER (JSON):
$context

STRUCTURE À SUIVRE (MARKDOWN):
$structure_education

TÂCHE:
Rédige l'article complet en Suédois suivant la structure.
";

$articleSchoolContent = generateAIContent($systemPromptSchool, $userPromptSchool);

// 4. Generate 'Work' Article
echo "\n💼 Generating 'Work' Article...\n";
$systemPromptWork = "Tu es un mentor de carrière expérimenté en Suède. Tu parles 'Vrai'. Ton objectif est de donner une vision réaliste mais inspirante.";
$userPromptWork = "
CONTEXTE MÉTIER (JSON):
$context

STRUCTURE À SUIVRE (MARKDOWN):
$structure_work

TÂCHE:
Rédige l'article complet en Suédois suivant la structure.
";

$articleWorkContent = generateAIContent($systemPromptWork, $userPromptWork);

// 5. Save Files (Draft Mode)
$outputDir = __DIR__ . "/content/drafts/{$slug}";
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true);
}

file_put_contents("$outputDir/utbildning.md", $articleSchoolContent);
file_put_contents("$outputDir/jobba-som.md", $articleWorkContent);

echo "\nwhite_check_mark Success! Drafts saved in: $outputDir\n";
echo "1. $outputDir/utbildning.md\n";
echo "2. $outputDir/jobba-som.md\n";
