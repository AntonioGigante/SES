-- Doctrine Migration File Generated on 2020-11-17 19:11:32

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

-- Version 20201116113213
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email);
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201116113213', CURRENT_TIMESTAMP);

-- Version 20201116114009
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email);
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201116114009', CURRENT_TIMESTAMP);

-- Version 20201116173259
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email);
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201116173259', CURRENT_TIMESTAMP);

-- Version 20201116174245
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201116174245', CURRENT_TIMESTAMP);

-- Version 20201116174427
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201116174427', CURRENT_TIMESTAMP);

-- Version 20201117171843
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users ADD brochure_filename VARCHAR(255) NOT NULL, CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201117171843', CURRENT_TIMESTAMP);

-- Version 20201117172358
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201117172358', CURRENT_TIMESTAMP);

-- Version 20201117173737
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users ADD foto VARCHAR(255) NOT NULL, CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
INSERT INTO migration_versions (version, executed_at) VALUES ('20201117173737', CURRENT_TIMESTAMP);

-- Version 20201117180942
ALTER TABLE participaciones CHANGE user user INT DEFAULT NULL, CHANGE campeonato campeonato INT DEFAULT NULL;
ALTER TABLE users ADD foto VARCHAR(255) NOT NULL, CHANGE victorias victorias INT DEFAULT NULL, CHANGE competicionesapuntado competicionesapuntado INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL;
CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username);
ALTER TABLE equipos CHANGE competicionesapuntadas competicionesapuntadas INT DEFAULT NULL, CHANGE competicionesganadas competicionesganadas INT DEFAULT NULL, CHANGE partidos partidos INT DEFAULT NULL;
ALTER TABLE pruebas CHANGE campeonato campeonato INT DEFAULT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20201117180942', CURRENT_TIMESTAMP);
