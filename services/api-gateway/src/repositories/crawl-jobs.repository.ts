import {inject} from '@loopback/core';
import {DefaultCrudRepository} from '@loopback/repository';
import {PostgresDataSource} from '../datasources';
import {CrawlJobs, CrawlJobsRelations} from '../models';

export class CrawlJobsRepository extends DefaultCrudRepository<
  CrawlJobs,
  typeof CrawlJobs.prototype.id,
  CrawlJobsRelations
> {
  constructor(
    @inject('datasources.Postgres') dataSource: PostgresDataSource,
  ) {
    super(CrawlJobs, dataSource);
  }
}
