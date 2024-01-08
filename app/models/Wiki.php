<?php

Class Wiki{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAllWikis(){
        $this->db->query("
                SELECT
                DISTINCT wiki.*,
                user.id as creatorId,
                user.full_name as creatorName,
                user.imgUrl as creatorImg,
                category.name as category,
                GROUP_CONCAT(DISTINCT tag.name) as tags
            FROM
                wiki
            JOIN category ON wiki.category_id = category.id
            INNER JOIN wiki_tag ON wiki.id = wiki_tag.wiki_id
            INNER JOIN tag ON wiki_tag.tag_id = tag.id
            INNER JOIN user ON wiki.created_by = user.id
            GROUP BY
                wiki.id,
                wiki.title,
                wiki.content,
                wiki.created_at,
                creatorId,
                creatorName,
                creatorImg,
                category,
                status;

        ");

        return $this->db->resultSet();
    }
    public function addWiki($data , $userId){
        $this->db->query("INSERT INTO wiki (title, content, created_by, category_id)
                  VALUES (:title, :content, :created_by, :category_id)");

        $this->db->bind(':title',$data['title']);
        $this->db->bind(':content',$data['description']);
        $this->db->bind(':created_by',$userId);
        $this->db->bind(':category_id',$data['category']);
        

        $insertedWiki = $this->db->execute();
        if($insertedWiki){
            $this->db->query("SELECT id FROM wiki ORDER BY id DESC LIMIT 1;");
            $lastWikiId = $this->db->single()->id;
            foreach ($data['tags'] as $tagId) {
                $this->db->query("INSERT INTO wiki_tag(wiki_id, tag_id) VALUES (:wiki_id, :tag_id) ");
                $this->db->bind(':wiki_id',$lastWikiId);
                $this->db->bind(':tag_id',$tagId);
                $wiki_tag = $this->db->execute();
            }
            return $wiki_tag;
        }else{
            return false;
        }
        
        
    }

    // public function getTagyById($id){
    //     $this->db->query("SELECT * FROM tag where id = :id");
    //     $this->db->bind(":id" , $id);
    //     return $this->db->single();
    // }

    

    // public function deleteTag($data){
    //     $this->db->query("DELETE FROM tag WHERE id = :id");
    //     $this->db->bind(":id" , $data["id"]);
    //     return $this->db->execute();
    // }
}