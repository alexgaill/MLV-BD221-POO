MVC => Model View Controller

Diviser le code en 3 parties

1/ Model
Classes qui vont être en lien avec la BDD
Elles récupères les données de la BDD ou permettent l'enregistrement de nouvelles

2/ View
Ce sont les templates
Ils contiennent le code html des pages

3/ Controller

Point central entre les model et les View

Un model récupère les données de la BDD, les envoie vers la Controller
Le controller traite les données et les envoie vers la vue pour l'affichage

A l'inverse, un template envoie des données vers un controller grâce au formulaire
Le controller traite les données (les sécurise) et les envoie au model qui les stocke en BDD
