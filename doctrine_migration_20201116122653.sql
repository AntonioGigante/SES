-- Doctrine Migration File Generated on 2020-11-16 12:26:53

-- Version 20201116104843
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201116104843', CURRENT_TIMESTAMP);

-- Version 20201116111445
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201116111445', CURRENT_TIMESTAMP);

-- Version 20201116112623
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201116112623', CURRENT_TIMESTAMP);
