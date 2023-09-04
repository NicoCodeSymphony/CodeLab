using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace WindowsFormsApp1
{

    public partial class Form3 : Form
    {
        SqlConnection con = new SqlConnection("Data Source=CCS-PC032\\SQLEXPRESS;Initial Catalog=Products;Integrated Security=True;Connect Timeout=30;Encrypt=False;TrustServerCertificate=False;ApplicationIntent=ReadWrite;MultiSubnetFailover=False");
        private DataGridView _dtg;

        public Form3()
        {
            InitializeComponent();
        }

       

        public Form3(DataGridView dtg) : this()
        {
            _dtg = dtg;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            int stocks = int.Parse(textBox2.Text) + int.Parse(textBox1.Text);
            

            con.Open();
            SqlCommand cmd = new SqlCommand("UPDATE products set Stocks=@Stocks where Name=@Name", con);
            cmd.Parameters.AddWithValue("@Name", label3.Text);
            cmd.Parameters.AddWithValue("@Stocks", stocks);

            cmd.ExecuteNonQuery();
            MessageBox.Show("Update Successfully");

            SqlCommand cmd2 = new SqlCommand("select * from products ORDER BY ID DESC", con);
            SqlDataAdapter da = new SqlDataAdapter(cmd2);
            DataTable dt = new DataTable();
            da.Fill(dt);
            _dtg.DataSource = dt;
            this.Close();

        }
    }
}
