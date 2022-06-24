create table user_t (
	u_id int unsigned auto_increment primary key,
   u_nick varchar(15) NOT NULL unique,
   u_pw varchar(15) not null,
   u_mail varchar(50) NOT NULL,
   u_date datetime DEFAULT current_timestamp()
);

CREATE TABLE local_t (
	loc_id int unsigned NOT NULL AUTO_INCREMENT primary key,
	loc_nm varchar(5) NOT NULL
);

create table galley_t (
	gal_id int unsigned NOT NULL AUTO_INCREMENT primary key,
	loc_id int unsigned NOT NULL,
	gal_nm varchar(30) NOT NULL,
	gal_intro varchar(1000) DEFAULT NULL,
	gal_img varchar(100) DEFAULT NULL,
	FOREIGN KEY (loc_id) REFERENCES local_t (loc_id)
);

create table show_t (
	s_id int unsigned NOT NULL AUTO_INCREMENT primary key,
    gal_id int unsigned NOT NULL, 
    s_nm varchar(100) not null,
    s_s_date date,
    s_e_date date,
    s_ctnt_img varchar(100),
    s_post varchar(1000),
    foreign key (gal_id) references galley_t (gal_id)
);

create table picture_t (
	pic_id int unsigned NOT NULL AUTO_INCREMENT primary key,
    s_id int unsigned not null,
    pic_img varchar(100),
    foreign key (s_id) references show_t (s_id)
);

create table board_t (
	b_id int unsigned NOT NULL AUTO_INCREMENT primary key,
    b_ctnt varchar(1000),
    b_date datetime default current_timestamp(),
    u_id int unsigned not null,
    foreign key (u_id) references user_t (u_id)
);

alter table galley_t add column gal_score int(10) NOT NULL;

create table visit_t (
	redate date primary key,
    cnt int(11)
);



INSERT INTO local_t (loc_nm) VALUES ('서울'), ('대구'), ('부산'), ('제주');

INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('1', '1', '그라운드시소성수', '그라운드시소성수(서울).PNG', 'img그라운드시소성수(서울)2.PNG');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('2', '1', '일민미술관', '일민미술관(서울).PNG', 'img일민미술관(서울)2.PNG');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('3', '1', '피크닉', '피크닉(서울).PNG', 'img피크닉(서울)2.png');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('4', '2', '대구미술관', '대구미술관.PNG', 'img대구미술관2.PNG');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('5', '2', '문화예술회관', '문화예술회관(대구).PNG', 'img문화예술회관(대구)2.PNG');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('6', '2', '소헌미술관', '봉산문화회관.PNG', 'img소헌미술관2.png');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('7', '3', '부산현대미술관', '부산미술관.PNG', 'img부산현대2.PNG');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('8', '3', '부산시립미술관', '부산시립미술관.PNG', 'img부산시립2.PNG');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('9', '3', '고은사진미술관', '고은사진미술관.PNG', 'img고은사진미술관2.png');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('10', '4', '제주현대미술관', '제주현대미술관.PNG', 'img현대미술관(제주)2.png');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('11', '4', '제주도립미술관', '제주도립미술관.PNG', 'img도립미술관(제주)2.png');
INSERT INTO `gallery_t` (`gal_id`, `loc_id`, `gal_nm`, `gal_intro`, `gal_img`) VALUES ('12', '4', '빛의벙커', '빛의벙커(제주).PNG', 'img빛의벙커(제주)2.png');



INSERT INTO `show_t` (`gal_id`, `s_nm`, `s_s_date`, `s_e_date`, `s_post`) VALUES ('4', '2022년 소장품 기획전 《나를 만나는 계절》', '2022.01.25', '2022.05.29', '대구미술관(현재).jpg');
INSERT INTO `show_t` (`gal_id`, `s_nm`, `s_s_date`, `s_e_date`, `s_post`) VALUES ('4', '2022 어미홀 프로젝트 《토끼와 평행정원》', '2022.05.03', '2022.05.25', '대구미술관(현재)_2.jpg');
INSERT INTO `show_t` (`gal_id`, `s_nm`, `s_s_date`, `s_e_date`, `s_post`) VALUES ('4', '이건희 컬렉션 특별전 웰컴 홈 향연', '2021.06.29', '2021.08.29', '대구미술관(지난).jpg');



SELECT * FROM show_t
WHERE s_e_date < NOW();


