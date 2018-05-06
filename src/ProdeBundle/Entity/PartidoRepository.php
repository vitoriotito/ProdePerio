<?
namespace ProdeBundle\Entity;
use Doctrine\ORM\EntityRepository;
class PartidoRepository extends EntityRepository
{
public function findProximosPartidos()
{

	$em = $this->getEntityManager();
	$dql = 'SELECT p
			FROM ProdeBundle:Partido p
			JOIN ProdeBundle:Equipo e
			'
	$consulta = $em->createQuery($dql);

	$consulta->setMaxResults(6);

	return $consulta;
	}
}