<?php return [
  'app' => [
    'name' => 'October CMS',
    'tagline' => 'Getting back to basics',
  ],
  'directory' => [
    'create_fail' => 'Kunde inte skapa mapp: :name',
  ],
  'file' => [
    'create_fail' => 'Kunde inte skapa fil: :name',
  ],
  'page' => [
    'invalid_token' => [
      'label' => 'Ogiltig säkerhetstoken',
    ],
  ],
  'combiner' => [
    'not_found' => 'Kombinationsfilen \':name\' kunde ej hittas',
  ],
  'system' => [
    'name' => 'System',
    'menu_label' => 'System',
    'categories' => [
      'cms' => 'CMS',
      'misc' => 'Övrigt',
      'logs' => 'Loggar',
      'mail' => 'Mail',
      'shop' => 'Affär',
      'team' => 'Lag',
      'users' => 'Användare',
      'system' => 'System',
      'social' => 'Social',
      'events' => 'Händelser',
      'customers' => 'Kunder',
      'my_settings' => 'Mina inställningar',
    ],
  ],
  'theme' => [
    'label' => 'Tema',
    'unnamed' => 'Namnlöst tema',
    'name' => [],
  ],
  'themes' => [
    'install' => 'Installerar teman',
    'installed' => 'Installerade teman',
    'no_themes' => 'Det finns inga teman installerade från marknadsplatsen.',
    'recommended' => 'Rekommenderat',
    'remove_confirm' => 'Är du säker på att du vill radera det här temat?',
  ],
  'plugin' => [
    'label' => 'Tillägg',
    'unnamed' => 'Namnlöst tillägg',
    'name' => [],
  ],
  'plugins' => [
    'enable_or_disable' => 'Aktivera eller inaktivera',
    'enable_or_disable_title' => 'Aktivera eller inaktivera tillägg',
    'install' => 'Installera tillägg',
    'install_products' => 'Installera produkter',
    'installed' => 'Installerade tillägg',
    'no_plugins' => 'Det finns inga tillägg installerade från marknadsplatsen.',
    'recommended' => 'Rekommenderat',
    'remove' => 'Ta bort',
    'refresh' => 'Uppdatera',
    'disabled_label' => 'Avaktivera',
    'disabled_help' => 'De avaktiverade tilläggen ignorerades av systemet.',
    'frozen_label' => 'Frys uppdateringar',
    'frozen_help' => 'Tillägg som är frusna kommer att ignoreras av uppdateringsprocessen.',
    'selected_amount' => 'Markerade tillägg: :amount',
    'remove_confirm' => 'Är du säker?',
    'remove_success' => 'Tilläggen raderades.',
    'refresh_success' => 'Tilläggen uppdaterades.',
    'disable_confirm' => 'Är du säker?',
    'disable_success' => 'Tilläggen avaktiverades.',
    'enable_success' => 'Aktiverade tilläggen.',
  ],
  'project' => [
    'attach' => 'Länka projekt',
    'detach' => 'Avlänka projekt',
    'none' => 'Inget',
    'id' => [
      'missing' => 'Vänligen välj ett Projekt-ID',
    ],
    'detach_confirm' => 'Vill du verkligen avlänka detta projekt?',
    'unbind_success' => 'Projektet har avlänkats',
  ],
  'settings' => [
    'search' => 'Sök',
  ],
  'mail' => [
    'smtp_ssl' => 'SSL-anslutning krävs',
  ],
  'mail_templates' => [
    'name_comment' => 'Unikt namn för att hänvisa till den här mallen',
    'test_send' => 'Skicka ett testmeddelande',
    'return' => 'Återvänd till mallistan',
    'test_confirm' => 'Ett testmeddelande kommer skickas till :email. Fortsätt?',
    'saving' => 'Sparar mall...',
    'sending' => 'Skickar testmeddelande...',
  ],
  'install' => [],
  'updates' => [
    'plugin_author' => 'Skapare',
    'plugin_not_found' => 'Plugin not found',
    'core_build' => 'Build :build',
    'core_build_help' => 'Senaste build är tillgänglig.',
    'themes' => 'Teman',
    'plugin_version_none' => 'Nytt tillägg',
    'plugin_current_version' => 'Nuvarande version',
    'theme_new_install' => 'Installation av nytt tema.',
    'theme_extracting' => 'Packar upp temat: :name',
    'update_label' => 'Uppdatera systemet',
    'update_loading' => 'Laddar tillgängliga uppdateringar...',
    'force_label' => 'Tvinga uppdatering',
    'found' => [
      'label' => 'Hittade nya uppdateringar!',
      'help' => 'Klicka på Uppdatera systemet för att påbörja processen.',
    ],
    'none' => [
      'label' => 'Inga uppdateringar',
      'help' => 'Inga nya uppdateringar hittades.',
    ],
    'important_action' => [
      'empty' => 'Välj åtgärd',
      'confirm' => 'Bekräfta uppdatering',
      'skip' => 'Hoppa över detta tillägg (en gång)',
      'ignore' => 'Hoppa över detta tillägg (alltid)',
    ],
    'important_action_required' => 'Åtgärd krävs',
    'important_view_guide' => 'Visa uppgraderingsguide',
    'important_alert_text' => 'Några uppdateringar behöver din uppmärksamhet.',
    'details_title' => 'Tilläggsdetaljer',
    'details_view_homepage' => 'Visa hemsida',
    'details_current_version' => 'Nuvarande version',
    'details_author' => 'Författare',
  ],
  'server' => [
    'connect_error' => 'Ett fel uppstod vid anslutning till servern.',
    'response_not_found' => 'Uppdateringsserver kunde ej hittas.',
    'response_invalid' => 'Felaktigt svar från servern.',
    'response_empty' => 'Tomt svar från servern.',
    'file_error' => 'Servern kunde inte leverera paketet.',
    'file_corrupt' => 'Filen från servern är korrupt.',
  ],
  'behavior' => [
    'missing_property' => 'Klassen :class måste definiera egenskapen $:property som används av :behavior -egenskapen',
  ],
  'config' => [
    'not_found' => 'Kunde inte hitta konfigurationsfilen :file definierad för :location',
    'required' => 'Konfigurationen som används i :location måste sända med ett värde :property',
  ],
  'zip' => [
    'extract_failed' => 'Kunde inte packa upp core-fil \':file\'.',
  ],
  'event_log' => [],
  'request_log' => [
    'empty_link' => 'Töm förfrågningsloggen',
    'empty_loading' => 'Tömmer förfrågningsloggen...',
    'empty_success' => 'Lyckades tömma förfrågningsloggen.',
    'return_link' => 'Återvänd till förfrågningsloggen',
    'id' => 'ID',
  ],
  'permissions' => [
    'name' => 'System',
    'manage_system_settings' => 'Hantera systeminställningar',
    'manage_software_updates' => 'Hantera systemuppdateringar',
    'access_logs' => 'Visa systemloggen',
    'manage_mail_templates' => 'Hantera e-postmallar',
    'manage_mail_settings' => 'Hantera e-postinställningar',
    'manage_other_administrators' => 'Hantera andra administratörer',
  ],
  'media' => [
    'invalid_path' => 'Felaktig filsökväg angiven: \':path\'.',
    'folder_size_items' => 'föremål',
  ],
];
