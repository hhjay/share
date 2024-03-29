<?php
class M_index extends CI_Model {
    public function __construct() 
    {
        parent::__construct();
    }

    public function get_content_title($num , $offset ) 
    {
        $query = $this ->db ->query("SELECT sh_posts.* , sh_user.* FROM sh_posts, sh_user WHERE sh_user.u_id = sh_posts.pt_uid  ORDER BY sh_posts.pt_id DESC LIMIT $offset, $num");
        return $query ->result();
    }

    public function get_posts_all()
    {
        return $this ->db ->count_all_results();
    }

    public function get_hot_cate()
    {
        $sql = "SELECT pt_cate, count(*) AS count 
                FROM sh_posts 
                GROUP BY pt_cate
                ORDER BY count DESC
                LIMIT 10";
        $query = $this ->db ->query($sql);
        $res = $query ->result();
        return $res;
    }
    public function get_hot_user()
    {
        $hotUser = array(); 
        $sql = "SELECT pt_uid, count(*) AS count 
                FROM sh_posts 
                GROUP BY pt_uid
                ORDER BY count DESC
                LIMIT 10";
        $query = $this ->db ->query($sql);
        $res = $query ->result();
        foreach ($res as $row)
        {
            $userow = $row ->pt_uid;
            $sql = "SELECT u_name FROM sh_user where u_id = '$userow' LIMIT 1";
            $query = $this ->db ->query($sql);
            $res = $query ->row_array();
            $useres = $res['u_name'];
            array_push($hotUser, $useres); 
        }
        return $hotUser;
    }
};

?>
