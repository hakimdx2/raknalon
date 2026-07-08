<?php
$data = json_decode(file_get_contents('data/professions.json'), true);
$cnc = $data[14];

echo "=== CNC-operatör Entry (Index 14) ===\n\n";
echo "Title: " . ($cnc['title'] ?? 'N/A') . "\n";
echo "Avg Salary: " . ($cnc['avg_salary'] ?? 'N/A') . "\n";
echo "Has Author: " . (isset($cnc['author']) ? 'YES' : 'NO') . "\n";
echo "Has FAQ: " . (isset($cnc['faq']) ? count($cnc['faq']) . ' FAQs' : 'NO') . "\n";
echo "Has Forecast: " . (isset($cnc['forecast']) ? 'YES' : 'NO') . "\n";
echo "Has Experience Levels: " . (isset($cnc['experience_levels']) ? count($cnc['experience_levels']) . ' levels' : 'NO') . "\n";
echo "Has Specialties: " . (isset($cnc['specialties']) ? count($cnc['specialties']) . ' specialties' : 'NO') . "\n";
echo "Has Career Paths: " . (isset($cnc['career_paths']) ? count($cnc['career_paths']) . ' paths' : 'NO') . "\n";
echo "Has Regional Salaries: " . (isset($cnc['regional_salaries']) ? count($cnc['regional_salaries']) . ' regions' : 'NO') . "\n";
echo "Has SCB: " . (isset($cnc['scb']) && $cnc['scb'] !== null ? 'YES' : 'NO') . "\n";
echo "Has Lifetime Earnings: " . (isset($cnc['lifetime_earnings']) ? 'YES' : 'NO') . "\n";
