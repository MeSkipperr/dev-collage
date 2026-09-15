import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.SwingConstants;

public class MainMain extends JFrame implements ActionListener{
	private Dimension dm=getToolkit().getScreenSize();
	private JButton[][] btnMain=new JButton[10][10];
	private int n=0;
	private int x=10;
	public MainMain() {
		// TODO Auto-generated constructor stub
		super("Bermain main");
		int h=(int) dm.getHeight();
		int w=(int)dm.getWidth();
		setBounds(w/2-250, h/2-275, 500,550);
		JLabel lblJudul=new JLabel("Bermain di Kelas IIIA");
		lblJudul.setFont(new Font("aria",1,24));
		lblJudul.setHorizontalAlignment(SwingConstants.CENTER);
		getContentPane().add(lblJudul, BorderLayout.NORTH);	
		
		JPanel panelTengah=new JPanel();
		panelTengah.setLayout(new GridLayout(x,x,2,2));
		for(int i=0;i<x;i++) {
			for(int j=0;j<x;j++) {
				btnMain[i][j]=new JButton("*");
				btnMain[i][j].setFont(new Font("aria",1,12));
				btnMain[i][j].addActionListener(this);
				panelTengah.add(btnMain[i][j]);
			}	
		}
		getContentPane().add(panelTengah,BorderLayout.CENTER);
		
		JButton btnUlang=new JButton("Ulang");
		btnUlang.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				// TODO Auto-generated method stub
				ulang();
			}
		});
		btnUlang.setFont(new Font("aria",1,20));
		JButton btnKeluar=new JButton("Keluar");
		btnKeluar.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				// TODO Auto-generated method stub
				System.exit(0);
			}
		});
		btnKeluar.setFont(new Font("aria",1,20));
		JPanel panelBawah = new JPanel();
		panelBawah.setLayout(new GridLayout(1,2,5,5));
		panelBawah.add(btnUlang);
		panelBawah.add(btnKeluar);
		getContentPane().add(panelBawah,BorderLayout.SOUTH);
		setVisible(true);
	}
	
	@Override
	public void actionPerformed(ActionEvent e) {
		// TODO Auto-generated method stub
		for(int i=0;i<x;i++) {
			for(int j=0;j<x;j++) {
				if(e.getSource()==btnMain[i][j]) {
					btnMain[i][j].setEnabled(false);
					if(n%2==0) {
						btnMain[i][j].setText("O");
					}else {
						btnMain[i][j].setText("X");
					}
					n++;
				}
			}	
		}
	}
	
	private void ulang() {
		n=0;
		for(int i=0;i<x;i++) {
			for(int j=0;j<x;j++) {
				btnMain[i][j].setText("");
				btnMain[i][j].setEnabled(true);
			}	
		}
	}
	
	public static void main(String[] args) {
		new MainMain();
	}
}
