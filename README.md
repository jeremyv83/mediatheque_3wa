# Application-jouet

L'ensemble du cours s'articule autour d'un projet d'application, dont le périmètre doit pouvoir être suffisamment souple pour intégrer les différentes fonctionnalités de la plate-forme, mais aussi être facilement compréhensible — voire adaptable — par les étudiants.

Dans les exercices décrits par la suite, nous prenons comme support la gestion d'une médiathèque (municipale, universitaire, associative, etc.), qui offre une grande diversité d'extensions et d'options possibles.

Les grandes lignes de l'application sont les suivantes :

**a)** La médiathèque rassemble toute une communauté de personnes qui ont potentiellement une grande diversité de rôles (visiteurs, adhérents, bibliothécaires, administrateurs de communauté, acheteurs, administrateurs système, etc.) ; rien n'interdit aux personnes impliqués de cumuler plusieurs rôles

**b)** La médiathèque abrite différents types de « documents » dont, par exemple, des livres, des CD, des DVD, des revues, etc. De surcroît, ces documents peuvent éventuellement être sur des supports physiques ou dématérialisés (au moins pour l'exercice) avec des mode d'accès spécifiques ;

**c)** la médiathèque offre un certain nombre de services dont le plus évident est l'emprunt, mais aussi la possibilité de réserver un document qui est actuellement sorti, la possibilité pour les adhérents de commenter les fiches des documents, de faire des propositions d'achat, de céder des documents personnels à la médiathèque, voire un système d'échanges entre adhérents (type boîte à livres); cette liste n'est naturellement pas exhaustive et un travail peut être fait avec les étudiants pour la compléter ;

**c’)** La médiathèque dispose d'un fonds de documents fragiles qui ne peuvent être empruntés mais sont consultables sur place, sur réservation, et éventuellement sur justificatif (chercheur, enseignant, journaliste, etc.)

**d)** la médiathèque organise également des rencontres avec des auteurs, ce qui peut donner lieu à un workflow pour l'organisation, un système d'inscription, etc. ;

**e)** naturellement, la médiathèque doit surveiller les emprunts et adopter une politique vis-à-vis des retardataires (avertissements, pénalités, etc.) ; l'état des documents est également regardé avec attention, et les documents endommagés peuvent être restaurés, remplacés ou retirés des rayons

> **f)** d'autres fonctionnalités peuvent être implémentées sous forme de services, comme
> * l'accès à des API pour l'enrichissement des fiches (typiquement Wikipedia voire, idéalement, Wikidata, mais aussi d'autres services spécialisés comme IMDB) ;
> * un service de recommandation serait également une bonne idée ;

> **g)** du point de vue administratif, nous souhaiterons implémenter la gestion des adhésions (leurs tarifs, leur renouvellement), la gestion du catalogue (achats, retraits) ;

**h)** une proposition intéressante d'extension serait la possibilité de réaliser des échanges inter-médiathèques (sur le modèle des bibliothèques universitaires) ce qui nécessiterait soit la construction d'une API ad hoc, soit l'utilisation de « _brokers_ » AMQP via le composant `Messenger`. Il y a naturellement beaucoup d'autres idées qui permettraient d'enrichir cette application et il ne tient qu'aux participants à la session de les ajouter.

**h')** Dans le cadre des échanges inter-bibliothèques « manuels », les responsables reçoivent des messages messages d'autres établissements (connus) et peuvent indiquer si le documents peut être expédié ou non (certains documents — fragiles, par exemple — ne peut pas sortir de la médiathèque)

**i)** La médiathèque s'abonne à des flux RSS de lieux culturels « intéressants ». Cela permet de créer un journal, sur le site, d'événéments concernant des activités culturelles. On voudrait également que des événements concernant des auteurs en particulier ou des livres apparaissent sur les fiches propres.

**j)** (_work in progress_ :)

Encore une fois, la description faite ci-dessus est un guide qui peut être étendu de bien des manières en fonction des groupes et des enseignants.

Bonus :

b1) La médiathèque dispose d'une cafétéria qui vend des produits listés sur une carte. Les abonnés bénéficient de tarifs réduits sur certaines consommations.

b2) On peut s'abonner aux cycles de conférences, en plus de la médiathèque. Les abonnés sont prioritaires pour réserver des places aux rencontres (la date de début des réservatins commence 2 semaines avant, par exemple)

b3) La médiathèque possède des documents rares ou fragiles. Ceux sont à accès limité :
- ils sont réservés à des chercheurs ou des personnes disponsant d'une autorisation spéciale
- ils ne peuvent être consultés que sur place
- ils sont quelquefois prêtés pour des expositions à des organismes tiers (comme des musées, par exemple)
